<?php

namespace App\Concretes;

use ApiResponse;
use Notification;
use Carbon\Carbon;
use App\Models\Student;
use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentServiceEnum;
use App\Interfaces\CheckoutInterface;
use App\Http\Repositories\CartRepository;
use App\Http\Repositories\InvoiceRepository;
use App\Http\Repositories\PaymentRepository;
use App\Http\Repositories\EnrollmentRepository;
use App\Http\Repositories\TeacherPaymentRepository;
use Illuminate\Http\Exceptions\HttpResponseException;

class CheckoutManual implements CheckoutInterface
{

    public function __construct(
        protected CartRepository $cartRepository,
        protected InvoiceRepository $invoiceRepository,
        protected PaymentRepository $paymentRepository,
        protected EnrollmentRepository $enrollmentRepository,
        protected TeacherPaymentRepository $teacherPaymentRepository,
    ){}

    public function pay(Student $user, PaymentServiceEnum $service, PaymentMethodEnum $method, array $data): void
    {

        try {
            $currentMonth = Carbon::now($user->country->timezone)->format('m');
            $currentYear = Carbon::now($user->country->timezone)->format('Y');

            // Create Invoice
            $invoice = $this->invoiceRepository->create([
                "student_id" => $user->id,
                "PaymentServiceEnum" => $service->value,
                "PaymentMethodEnum" => $method->value,
                "paymentData" => $data,
                "totalCost" => $data["totalCost"],
                "itemCount" => count($data["items"]),
            ]);


            // Create Student Payments and enrollments
            foreach ($data["items"] as $item) {
                $courseExpiresAtMonth = $item->course->curriculum->to->value; //2

                if ($currentMonth > $courseExpiresAtMonth)
                    $year = $currentYear + 1;

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
                    "expired_at" => Carbon::create($year, $courseExpiresAtMonth,1, 0, 0, 0, $user->country->timezone)
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

            //send email from here
            Notification::via([new NotificationEmail()])->send($user->fresh(), $invoice, "invoice");

        } catch (\Exception $e) {

            throw new HttpResponseException(ApiResponse::sendError(["Checkout error" => [$e->getMessage()]], 'Checkout error please try again later', null));
        }
    }



}
