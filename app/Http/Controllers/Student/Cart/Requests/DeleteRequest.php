<?php

namespace App\Http\Controllers\Student\Cart\Requests;

use App\Concretes\ValidateRequest;
use App\Models\Cart;

class DeleteRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => [
                "required",
                "integer",
                "exists:carts,id",
                function($attribute, $value, $fail) {
                    if ($this->attributes->get("guard") !== "admin")
                    {
                        $cart = Cart::find($value);
                        if (isset($cart) && $cart->student_id != auth("student")->id()) {
                            $fail('This course in cart not belongs to this student.');
                        }
                    }
                },
            ],
        ];
    }
}
