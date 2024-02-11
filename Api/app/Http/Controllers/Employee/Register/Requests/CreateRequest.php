<?php

namespace App\Http\Controllers\Employee\Register\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\AdminRoleEnum;
use App\Enums\GenderEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "name" => "required|string|regex:/^[a-zA-Z0-9 .,?!\'’\"-]+$/u",
            "phone" => "required|digits:10|unique:admins",
            "email" => "required|email|unique:admins",
            "password" => ["required", "confirmed", Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            "password_confirmation" => "required",
            "AdminRoleEnum" => ["required", "string", new Enum(AdminRoleEnum::class)],
            "GenderEnum" => ["required", "string", new Enum(GenderEnum::class)],
            "national_id" => "required|digits:14|unique:admins",
            "image" => "nullable|array|size:2",
            "image.file" => "nullable|image",
            "image.title" => "nullable|string",
            "country_id" => "required|exists:countries,id"
        ];
    }
}
