<?php

namespace App\Http\Controllers\Admin\Teacher\Register\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use App\Enums\AdminRoleEnum;
use App\Enums\AdminStatusEnum;
use App\Enums\GenderEnum;
use App\Enums\TeacherStatusEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:teachers,id",
            "NamePrefixEnumTable" => [
                "required", "integer",
                Rule::exists('enumerations', 'id')->where(function ($query){
                    return $query->where('key', 'name_prefixes');
                })
            ],
            "name" => "required|string|regex:/^[a-zA-Z0-9 .,?!\'’\"-]+$/u",
            "phone" => "required|digits:10|unique:admins,phone,".$this->id,
            "email" => "required|email|unique:admins,email,".$this->id,
            "GenderEnum" => ["required", "string", new Enum(ActiveEnum::class)],
            "TeacherStatusEnum" =>["required", "string", new Enum(TeacherStatusEnum::class)],
            "blocked_reason" => "required_if:TeacherStatusEnum," . TeacherStatusEnum::Blocked->value,
            "image" => "nullable|image",
            "contract" => "nullable|file|mimes:pdf",
            "country_id" => "required|exists:countries,id",
            "password" => ["nullable", "confirmed", Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            "password_confirmation" => "required_with:password",
            "SubjectsEnumTable" => "required|array",
            "SubjectsEnumTable.*" =>
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    return $query->where('key', 'education_subjects');
                }),
        ];
    }
}
