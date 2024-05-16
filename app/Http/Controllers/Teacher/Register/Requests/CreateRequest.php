<?php

namespace App\Http\Controllers\Teacher\Register\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\GenderEnum;
use App\Enums\NamePrefixEnum;
use App\Enums\TeacherStatusEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "prefix" => ["required", "string", new Enum(NamePrefixEnum::class)],
            "name" => "required|string|regex:/^[a-zA-Z0-9 .,?!\'’\"-]+$/u",
            "phone" => "required|digits:10|unique:teachers",
            "email" => "required|email|unique:teachers",
            "national_id" => "nullable|digits:14|unique:admins",
            "password" => ["required", "confirmed", Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            "password_confirmation" => "required",
            "GenderEnum" => ["required", "string", new Enum(GenderEnum::class)],
            "TeacherStatusEnum" => ["required", "string", new Enum(TeacherStatusEnum::class)],
            "image.file" => "required|image",
            "image.title" => "nullable|string",
            "country_id" => "required|exists:countries,id",
            "stage_id" => "required|exists:stages,id",
            "subject_id" => "required|exists:subjects,id",
        ];
    }
}
