<?php

namespace App\Http\Controllers\Teacher\PaymentRequest\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\TeacherPaymentStatusEnum;
use App\Models\PaymentRequest;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            'id' => [
                "required",
                "integer",
                "exists:payment_requests,id",
                function ($attribute, $value, $fail) {
                    $payment = PaymentRequest::find($value);

                    if ($payment->TeacherPaymentStatusEnum == TeacherPaymentStatusEnum::Paid->value){
                        $fail("Sorry you can not update this record because this request already " . $payment->TeacherPaymentStatusEnum);
                    }
                }
            ],
        ];
    }
}
