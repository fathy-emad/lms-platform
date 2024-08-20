<?php

namespace App\Http\Controllers\AuthStudent\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\GenderEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "name" => "required|string|regex:/^[a-zA-Z0-9 .,?!\'’\"-]+$/u",
            "phone" => "required|digits:10|unique:students",
            "email" => "required|email|unique:teachers",
            "national_id" => "nullable|digits:14|unique:students",
            "password" => ["required", "confirmed", Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            "password_confirmation" => "required",
            "GenderEnum" => ["required", "string", new Enum(GenderEnum::class)],
            "image.file" => "nullable|image",
            //"image.title" => "nullable|string",
            "country_id" => "required|exists:countries,id",
            "born" => "required|date_format:Y-m-d",
            "school" => "nullable|string"
        ];
    }

}
