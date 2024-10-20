<?php

namespace App\Http\Controllers\Teacher\PaymentRequest\Requests;

use App\Concretes\ValidateRequest;
use App\Models\PaymentRequest;
use App\Models\TeacherPayment;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            'teacher_id' => [
                'required',
                'integer',
                'exists:teachers,id',
                'in:'.auth('teacher')->id(),
                function ($attribute, $value, $fail) {
                    $payments = TeacherPayment::where(["teacher_id" => $value, "TeacherPaymentStatusEnum" => "pending"])->get();
                    $requests = PaymentRequest::where("teacher_id", $value)->whereIn("TeacherPaymentStatusEnum", ['in-review', 'on-way'])->get();

                    if ($payments->sum("cost") < 0)
                        $fail("Sorry your request should over 3000 LE! and you have " . $payments->sum('cost') ."LE");

                    if ($requests->count())
                        $fail("Sorry you have request not finished yet.");

                }
            ],
        ];
    }
}
