<?php

namespace App\Http\Controllers\AuthStudent\Requests;

use App\Concretes\ValidateRequest;

class ResetPasswordRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "email" => "required|email|exists:admins,email",
        ];
    }

}
