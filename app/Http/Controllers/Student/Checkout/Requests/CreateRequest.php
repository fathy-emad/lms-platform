<?php

namespace App\Http\Controllers\Student\Checkout\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\PaymentServiceEnum;
use App\Models\Cart;
use Illuminate\Validation\Rules\Enum;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "paymentService" => ["required", "string", new Enum(PaymentServiceEnum::class)],
            "paymentMethod" => "required|string|in:card,wallet",
            "student_id" => [
                "required",
                "integer",
                "exists:students,id",
                "in:". auth("student")->id(),
                function ($attribute, $value, $fail) {
                    if(! Cart::where("student_id", $this->student_id)->exists())
                    {
                        return $fail("You do not have any items in cart");
                    }
                }
            ],
        ];
    }
}
