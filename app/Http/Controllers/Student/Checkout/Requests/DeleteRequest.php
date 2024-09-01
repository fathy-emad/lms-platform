<?php

namespace App\Http\Controllers\Student\Checkout\Requests;

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
            ],
        ];
    }
}
