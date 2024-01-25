<?php

namespace App\Http\Controllers\AuthAdmin\Requests;

use App\Concretes\ValidateRequest;
use Illuminate\Validation\Rules\Password;

class ChangePasswordRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "currentPassword" => "required|current_password:admin",
            "password" => ["required", "confirmed", Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            "password_confirmation" => "required",
        ];
    }

}
