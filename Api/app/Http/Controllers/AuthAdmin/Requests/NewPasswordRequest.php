<?php

namespace App\Http\Controllers\AuthAdmin\Requests;

use App\Concretes\ValidateRequest;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class NewPasswordRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "password" => ["required", "confirmed", Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            "password_confirmation" => "required",
            "email" => "required|email|exists:admins,email",
            "verifyToken" => "required|string|exists:admins",
        ];
    }

    public function messages(): array
    {
        return [
            "verifyToken.exists" => "This token is invalid or expired please resend code"
        ];

    }

}
