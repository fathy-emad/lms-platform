<?php

namespace App\Http\Controllers\AuthStudent\Requests;

use App\Concretes\ValidateRequest;
use App\Models\Student;
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
            "email" => "required|email|exists:students,email",
            "verifyToken" => [
                "required",
                "array",
                function ($attribute, $value, $fail) {
                    $student = Student::where("email", $this->email)->where("verifyToken", implode("", $value))
                        ->where('updated_at', '>=', Carbon::now("UTC")->subMinutes(5))->exists();

                    if (! $student)
                        $fail("This token is invalid or expired please try again or resend code");
                }
            ],
            "terms_of_service_and_privacy_policy" => "required|in:1",
        ];
    }

    public function messages(): array
    {
        return [
            "verifyToken.exists" => "This token is invalid or expired please resend code"
        ];
    }



    public function attributes(): array
    {
        return [
            "email" => __("attributes.email"),
            "password" => __("attributes.password"),
            "password_confirmation" => __("attributes.password_confirmation"),
            "verifyToken" => __("attributes.verifyToken"),
            "terms_of_service_and_privacy_policy" => __("lang.terms_condition") . " " . __("lang.privacy_policy"),
        ];
    }

}
