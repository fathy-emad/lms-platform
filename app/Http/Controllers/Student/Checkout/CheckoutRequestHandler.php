<?php

namespace App\Http\Controllers\Student\Checkout;

use Exception;
use ApiResponse;
use Carbon\Carbon;
use App\Models\Cart;
use App\Services\PaymobService;
use App\Concretes\RequestHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Repositories\CartRepository;
use App\Http\Repositories\PaymentRepository;
use App\Http\Repositories\InvoiceRepository;
use App\Http\Repositories\EnrollmentRepository;
use App\Http\Repositories\TeacherPaymentRepository;

class CheckoutRequestHandler extends RequestHandler
{
    public function __construct(
        protected PaymobService $paymobService,
        protected CartRepository $cartRepository,
        protected InvoiceRepository $invoiceRepository,
        protected PaymentRepository $paymentRepository,
        protected EnrollmentRepository $enrollmentRepository,
        protected TeacherPaymentRepository $teacherPaymentRepository,
    ){}

    //Get Cart items
    public function cartItems(?int $userId): array
    {
        $total = 0;
        $items = [];
        $cartItems = Cart::where("student_id", $userId ?? auth("student")->id())->get();
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

    public function checkout($request): string
    {
        $totalCost = (float) $this->cartItems(null)["totalCost"];
        return $this->paymobService->pay($totalCost, $request["paymentMethod"]);
//        if ($request["paymentService"] == PaymentServiceEnum::Paymob->value) {
//            return $this->paymobService->pay($totalCost, $request["paymentMethod"]);
//        }

    }

    public function checkoutCallback($request): JsonResponse
    {
        $user = auth('student')->user();
        $items = $this->cartItems($user->id)["items"];
        $currentMonth = Carbon::now($user->country->timezone)->format('m');
        $currentYear = Carbon::now($user->country->timezone)->format('Y');

        //if request success do

        DB::beginTransaction();

        try {
            // Create Invoice
            $invoice = $this->invoiceRepository->create([
                "student_id" => $user->id,
                "paymentService" => "paymob",
                "paymentData" => ["data" => ["name" => "bla bla"]],
                "totalCost" => 1000,
                "itemCount" => count($items),
            ]);

            // Create Student Payments and enrollments
            foreach ($items as $item) {
                $courseExpiresAtMonth = $item->course->curriculum->to->value;

                if ($currentMonth > $courseExpiresAtMonth)
                    $currentYear += 1;

                // Create Payment Record
                $payment = $this->paymentRepository->create([
                    "invoice_id" => $invoice->id,
                    "cost" => $item->course->cost["course"],
                    "course_id" => $item->course_id,
                ]);

                // Create Enrollment Record
                $enrollment = $this->enrollmentRepository->create([
                    "invoice_id" => $invoice->id,
                    "student_id" => $user->id,
                    "payment_id" => $payment->id,
                    "course_id" => $item->course_id,
                    "expired_at" => Carbon::create($currentYear, $courseExpiresAtMonth,1, 0, 0, 0, $user->country->timezone)
                        ->endOfMonth()->setTime(23, 59, 59)->copy()->setTimezone('UTC'),
                ]);

                //Create Teacher Payment
                $this->teacherPaymentRepository->create([
                    "invoice_id" => $invoice->id,
                    "student_id" => $user->id,
                    "payment_id" => $payment->id,
                    "course_id" => $item->course_id,
                    "teacher_id" => $item->course->teacher->id,
                    "enrollment_id" => $enrollment->id,
                    "cost" => (float) $item->course->cost["course"] * $item->course->percentage,
                ]);

                //Delete Cart Item
                $this->cartRepository->delete($item->id);
            }

            // Commit the transaction
            DB::commit();

            return ApiResponse::sendSuccess([], "Checkout created successfully", null);
        } catch (Exception $e) {
            // Rollback the transaction if any exception occurs
            DB::rollBack();

            // Handle the exception (log it, rethrow it, return an error response, etc.)
            return ApiResponse::sendError(["something went wrong" => [$e->getMessage()]], 'Checkout Error', null);
        }

    }
}
