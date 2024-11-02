<?php

namespace App\Http\Controllers\AuthStudent\Requests;

use App\Concretes\ValidateRequest;

class ForgetPasswordRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "email" => "required|email|exists:students,email",
        ];
    }

    public function attributes(): array
    {
        return [
            "email" => __("attributes.email"),
        ];
    }

}
