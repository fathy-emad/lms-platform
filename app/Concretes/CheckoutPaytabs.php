<?php

namespace App\Concretes;

use ApiResponse;
use Illuminate\Support\Facades\Log;
use Notification;
use Carbon\Carbon;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentServiceEnum;
use App\Interfaces\CheckoutInterface;
use App\Http\Repositories\CartRepository;
use App\Http\Repositories\InvoiceRepository;
use App\Http\Repositories\PaymentRepository;
use App\Http\Repositories\EnrollmentRepository;
use App\Http\Repositories\TeacherPaymentRepository;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Http;

class CheckoutPaytabs implements CheckoutInterface
{
    protected string $paytabsEndpoint;
    protected string $paytabsProfileId;
    protected string $paytabsServerKey;

    public function __construct(
        protected CartRepository $cartRepository,
        protected InvoiceRepository $invoiceRepository,
        protected PaymentRepository $paymentRepository,
        protected EnrollmentRepository $enrollmentRepository,
        protected TeacherPaymentRepository $teacherPaymentRepository,
    ) {
        $this->paytabsEndpoint = config('services.paytabs.endpoint'); // PayTabs endpoint from config
        $this->paytabsProfileId = config('services.paytabs.profile_id'); // PayTabs profile ID
        $this->paytabsServerKey = config('services.paytabs.server_key'); // PayTabs server key
    }

    public function pay(array $data): mixed
    {
        $user = Student::find($data["student_id"]);
        $cartData = $this->cartItems($user->carts);
        $service = PaymentServiceEnum::from($data["PaymentServiceEnum"]);
        $method = PaymentMethodEnum::from($data["PaymentMethodEnum"]);

        try {

            //Create invoice
            $invoice = $this->invoiceRepository->create([
                "student_id" => $user->id,
                "PaymentServiceEnum" => $service->value,
                "PaymentMethodEnum" => $method->value,
                "paymentData" => ["cart_data" => $cartData],
                "totalCost" => $cartData["totalCost"],
                "itemCount" => count($cartData["items"]),
                "PaymentStatusEnum" => "pending"
            ]);

            // Prepare payment details for PayTabs
            $paymentDetails = $this->preparePaymentDetails($user, $invoice);

            // Send the payment request to PayTabs
            $paytabsResponse = $this->sendPaytabsPayment($paymentDetails);

            if ($paytabsResponse->status() == 200)
            {
                $invoice->update([
                    "paymentData" => [
                        "cart_data" => $cartData,
                        "payment_data" => $paytabsResponse->json(),
                    ],
                ]);
                return $paytabsResponse->json();
            }


            else
                throw new HttpResponseException(ApiResponse::sendError(["Checkout error" => $paytabsResponse->json()], 'Checkout error please try again later', null));

        } catch (\Exception $e) {
            throw new HttpResponseException(ApiResponse::sendError(["Checkout error" => [$e->getMessage()]], 'Checkout error, please try again later', null));
        }
    }

    // Prepare payment details for PayTabs API request
    private function preparePaymentDetails($user, $invoice): array
    {
        return [
            "profile_id" => $this->paytabsProfileId,
            "tran_type" => "sale",
            "tran_class" => "ecom",
            "cart_id" => uniqid(),
            "cart_currency" => "EGP",
            "cart_amount" => $invoice->totalCost,
            "cart_description" => "Loomyedu platform purchase",
            "customer_details" => [
                "name" => $user->name,
                "email" => $user->email,
                "phone" => $user->phone,
                "street1" => 'cairo',
                "city" => 'cairo',
                "country" => 'EGYPT',
            ],
            "return" => route('payment.callback', ['invoice_id' => $invoice->id]),
            "callback" => route('payment.paytabs.callback'),
            "hide_shipping" => true,
        ];
    }

    // Send the payment request to PayTabs API
    private function sendPaytabsPayment(array $paymentDetails)
    {
        $response = Http::withHeaders([
            'Authorization' => $this->paytabsServerKey,
            'Content-Type' => 'application/json',
        ])->post($this->paytabsEndpoint, $paymentDetails);

        return $response;
    }

    // Finalize payment process (create enrollment, payment, teacher payment)
    private function finalizePayment($invoice, $cartData, $user)
    {
        $currentMonth = Carbon::now($user->country->timezone)->format('m');
        $currentYear = Carbon::now($user->country->timezone)->format('Y');

        foreach ($cartData["items"] as $item) {

            $courseExpiresAtMonth = $item->course->curriculum->to->value;

            if ($currentMonth > $courseExpiresAtMonth)
                $year = $currentYear + 1;

            $payment = $this->paymentRepository->create([
                "invoice_id" => $invoice->id,
                "cost" => $item->course->cost["course"],
                "course_id" => $item->course_id,
            ]);

            $enrollment = $this->enrollmentRepository->create([
                "invoice_id" => $invoice->id,
                "student_id" => $user->id,
                "payment_id" => $payment->id,
                "course_id" => $item->course_id,
                "expired_at" => Carbon::create($year, $courseExpiresAtMonth,1, 0, 0, 0, $user->country->timezone)
                    ->endOfMonth()->setTime(23, 59, 59)->copy()->setTimezone('UTC'),            ]);

            $this->teacherPaymentRepository->create([
                "invoice_id" => $invoice->id,
                "student_id" => $user->id,
                "payment_id" => $payment->id,
                "course_id" => $item->course_id,
                "teacher_id" => $item->course->teacher->id,
                "cost" => $item->course->cost["course"] * $item->course->percentage,
                "enrollment_id" => $enrollment->id,
            ]);

            $this->cartRepository->delete($item->id);
        }

        Notification::via([new NotificationEmail()])->send($user->fresh(), $invoice, "invoice");
    }

    public function cartItems($cartItems): array
    {
        $total = 0;
        $items = [];
        foreach ($cartItems as $key => $item)
        {
            $items[$key] = $item;
            $total += (float) $item->course->cost["course"];
        }

        return [
            "totalCost" => (float) $total,
            "items" => $items
        ];
    }

    public function handleReturnPaytabs(Request $request, $invoice_id)
    {
        // Retrieve the invoice and student ID
        $invoice = $this->invoiceRepository->getById($invoice_id);
        $student_id = $invoice->student_id;
        return redirect()->route('student.enrolled_courses');

    }

    public function handleCallbackPaytabs(Request $request)
    {
        $callbackData = $request->all();
        Log::info('PayTabs Callback Data:', $callbackData);

        if (isset($callbackData['tran_ref']) && isset($callbackData['response_code'])) {
            $invoice = $this->invoiceRepository->findByTransactionId($callbackData['tran_ref']); // Assuming you have a method to find the invoice by transaction ID

            if ($invoice) {
                if ($callbackData['response_code'] == '100') { // 100 typically indicates success
                    $invoice->update(['PaymentStatusEnum' => 'paid']);
                    $this->finalizePayment($invoice, $invoice->paymentData['cart_data'], $invoice->student);
                    return response()->json(['message' => 'Payment successfully processed'], 200);
                } else {
                    // Transaction failed
                    $invoice->update(['PaymentStatusEnum' => 'failed']);
                    return response()->json(['message' => 'Payment failed'], 400);
                }
            } else {
                return response()->json(['message' => 'Invoice not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid callback data'], 400);
        }
    }

}
