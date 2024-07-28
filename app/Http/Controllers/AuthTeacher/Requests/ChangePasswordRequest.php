<?php

namespace App\Http\Controllers\AuthTeacher\Requests;

use App\Concretes\ValidateRequest;
use Illuminate\Validation\Rules\Password;

class ChangePasswordRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:teachers,id|in:" . auth("teacher")->id(),
            "currentPassword" => "required|current_password:teacher",
            "password" => ["required", "confirmed", Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            "password_confirmation" => "required",
        ];
    }

}
