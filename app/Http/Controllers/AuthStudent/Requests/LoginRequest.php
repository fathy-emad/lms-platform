<?php

namespace App\Http\Controllers\AuthStudent\Requests;

use App\Concretes\ValidateRequest;

class LoginRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            //"phone" => "nullable|required_without:email|digits:10",
            "email" => "required|email",
            "password" => "required"
        ];
    }


    public function attributes(): array
    {
        return [
            "email" => __("attributes.email"),
            "password" => __("attributes.password"),
        ];
    }

}
