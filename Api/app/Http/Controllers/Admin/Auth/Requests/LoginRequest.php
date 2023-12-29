<?php

namespace App\Http\Controllers\Admin\Auth\Requests;

use App\Concretes\ValidateRequest;

class LoginRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "email" => "required|email",
            "password" => "required"
        ];
    }

}
