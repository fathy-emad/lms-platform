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
            "phone" => "required|digits:10|unique:students,phone",
            "email" => "required|email|unique:students,email",
            "national_id" => "nullable|digits:14|unique:students",
            //"password" => ["required", "confirmed", Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            "password" => ["required", "confirmed", Password::min(8)],
            "password_confirmation" => "required",
            "GenderEnum" => ["required", "string", new Enum(GenderEnum::class)],
            "image.file" => "nullable|image",
            "country_id" => "required|exists:countries,id",
            "born" => "required|date_format:Y-m-d",
            "school" => "required|string",
            "terms_of_service_and_privacy_policy" => "required|in:1",
        ];
    }

    public function attributes(): array
    {
        return [
            "name" => __("attributes.name"),
            "phone" => __("attributes.phone"),
            "email" => __("attributes.email"),
            "password" => __("attributes.password"),
            "password_confirmation" => __("attributes.password_confirmation"),
            "born" => __("attributes.born"),
            "school" => __("attributes.school"),
            "terms_of_service_and_privacy_policy" => __("lang.terms_condition") . " " . __("lang.privacy_policy"),
        ];
    }

}
