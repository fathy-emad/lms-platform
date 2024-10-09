<?php

namespace App\Http\Controllers\SettingEducation\Curriculum\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use App\Enums\EduTermsEnum;
use App\Enums\EduTypesEnum;
use App\Enums\MonthsEnum;
use Illuminate\Validation\Rules\Enum;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:curricula,id",
            "subject_id" => "required|integer|exists:subjects,id",
            "curriculum" => "required|array|min:1",
            "curriculum.ar" =>  "required|string|regex:/^[\x{0600}-\x{06FF}\s\W]+$/u",
            "curriculum.*" => "nullable|string",
            "EduTermsEnums" => "required|array|min:1",
            "EduTermsEnums.*" => [new Enum(EduTermsEnum::class)],
            "EduTypesEnums" => "required|array|min:1",
            "EduTypesEnums.*" => [new Enum(EduTypesEnum::class)],
            "from" => ["required", "int", new Enum(MonthsEnum::class)],
            "to" => ["required", "int", new Enum(MonthsEnum::class)],
            "ActiveEnum" => ["sometimes", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
