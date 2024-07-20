<?php

namespace App\Http\Controllers\AuthTeacher\Requests;

use App\Concretes\ValidateRequest;

class ForgetPasswordRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "email" => "required|email|exists:teachers,email",
        ];
    }

}
