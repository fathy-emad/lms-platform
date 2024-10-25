<?php

namespace App\Http\Controllers\Student\Checkout\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentServiceEnum;
use App\Models\Cart;
use Illuminate\Validation\Rules\Enum;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        $auth = $this->attributes->get("guard") == "admin" ? "" : "in:" . auth("student")->id();

        return [
            "PaymentServiceEnum" => ["required", "string", new Enum(PaymentServiceEnum::class)],
            "PaymentMethodEnum" => ["required", "string", new Enum(PaymentMethodEnum::class)],
            "transactionTo" => "nullable|digits:11|required_if:PaymentServiceEnum,CheckoutManual",
            "student_id" => [
                "required",
                "integer",
                "exists:students,id",
                $auth,
                function ($attribute, $value, $fail) {
                    if(! Cart::where("student_id", $this->student_id)->exists())
                    {
                        return $fail("You do not have any courses in cart");
                    }
                }
            ],
        ];
    }
}
