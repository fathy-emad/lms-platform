<?php

namespace App\Http\Controllers\AuthStudent\Requests;

use App\Concretes\ValidateRequest;

class LoginRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "phone" => "nullable|required_without:email|digits:10",
            "email" => "nullable|required_without:phone|email",
            "password" => "required"
        ];
    }

}
