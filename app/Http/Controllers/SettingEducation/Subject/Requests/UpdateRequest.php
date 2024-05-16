<?php

namespace App\Http\Controllers\SettingEducation\Subject\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use App\Enums\SystemConstantsEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:subjects,id",
            "year_id" => "required|integer|exists:years,id",
            "edu_subject_id" => "required|integer|exists:edu_subjects,id",
            "ActiveEnum" => ["sometimes", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
