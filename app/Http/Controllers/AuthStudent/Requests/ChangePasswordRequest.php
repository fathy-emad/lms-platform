<?php

namespace App\Http\Controllers\AuthStudent\Requests;

use App\Concretes\ValidateRequest;
use Illuminate\Validation\Rules\Password;

class ChangePasswordRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:students,id|in:" . auth("student")->id(),
            "currentPassword" => "required|current_password:teacher",
            "password" => ["required", "confirmed", Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            "password_confirmation" => "required",
        ];
    }

}
