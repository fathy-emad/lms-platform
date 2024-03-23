<?php

namespace App\Http\Controllers\AuthAdmin\Requests;

use App\Concretes\ValidateRequest;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class VerifyTokenRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "email" => "required|email|exists:admins,email",
            "verifyToken" => [
                "required",
                "string",
                Rule::exists('admins', 'verifyToken')->where(function ($query){
                    return $query->where("email", $this->email)
                        ->where('updated_at', '>=', Carbon::now()->subMinutes(5));
                }),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            "verifyToken.exists" => "This token is invalid or expired please resend code"
        ];

    }

}
