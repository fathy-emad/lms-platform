<?php

namespace App\Http\Controllers\SettingEducation\Subject\Requests;

use App\Enums\ActiveEnum;
use Illuminate\Validation\Rule;
use App\Concretes\ValidateRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:subjects,id",
            "year_id" => "required|integer|exists:years,id",
            "edu_subject_id" => [
                "required",
                "integer",
                "exists:edu_subjects,id",
                Rule::unique('subjects', 'edu_subject_id')->where(function ($query){
                    return $query->where('year_id', $this->year_id);
                })
            ],
            "ActiveEnum" => ["sometimes", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
