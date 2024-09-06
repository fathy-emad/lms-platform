<?php

namespace App\Http\Controllers\AuthAdmin\Requests;

use Carbon\Carbon;
use App\Models\Admin;
use App\Concretes\ValidateRequest;
use Illuminate\Validation\Rules\Password;

class NewPasswordRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "password" => ["required", "confirmed", Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            "password_confirmation" => "required",
            "email" => "required|email|exists:admins,email",
            "verifyToken" => [
                "required",
                "array",
                function ($attribute, $value, $fail) {
                    $admin = Admin::where("email", $this->email)->where("verifyToken", implode("", $value))
                        ->where('updated_at', '>=', Carbon::now("UTC")->subMinutes(5))->exists();

                    if (! $admin)
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
