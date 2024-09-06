<?php

namespace App\Http\Controllers\AuthTeacher\Requests;

use App\Concretes\ValidateRequest;
use App\Models\Teacher;
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
            "email" => "required|email|exists:teachers,email",
            "verifyToken" => [
                "required",
                "array",
                function ($attribute, $value, $fail) {
                    $teacher = Teacher::where("email", $this->email)->where("verifyToken", implode("", $value))
                        ->where('updated_at', '>=', Carbon::now("UTC")->subMinutes(5))->exists();

                    if (! $teacher)
                        $fail("This token is invalid or expired please try again or resend code");
                }
            ],
        ];
    }

    public function messages(): array
    {
        return [];

    }

}
