<?php

namespace App\Http\Controllers\Teacher\PaymentRequest\Requests;

use App\Concretes\ValidateRequest;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            'id' => "required|integer|exists:payment_requests,id",
        ];
    }
}
