<?php

namespace App\Http\Controllers\SettingEducation\Curriculum\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use App\Enums\EduTermsEnum;
use App\Enums\EduTypesEnum;
use App\Enums\MonthsEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "subject_id" => "required|integer|exists:subjects,id",
            "curriculum" => ["required","string", "min:2"],
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
