<?php

namespace App\Http\Controllers\SettingEducation\Curriculum\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use App\Enums\MonthsEnum;
use App\Enums\SystemConstantsEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:curricula,id",
            "subject_id" => "required|integer|exists:subjects,id",
            "CurriculumEnumTable" => [
                "required",
                "integer",
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    return $query->where('key', SystemConstantsEnum::CurriculumEnumTable->value);
                }),
                Rule::unique('curricula')->where(function ($query) {
                    $query->where('CurriculumEnumTable', $this->CurriculumEnumTable) ->where('subject_id', $this->subject_id);
                    foreach ($this->TermsEnumTable as $term)  $query->whereJsonContains('TermsEnumTable', (string) $term);
                    foreach ($this->TypesEnumTable as $type) $query->whereJsonContains('TypesEnumTable', (string) $type);
                    return $query;
                })->ignore($this->id),
            ],
            "TermsEnumTable" => "required|array",
            "TermsEnumTable.*" =>
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    return $query->where('key', SystemConstantsEnum::TermEnumTable->value);
                }),
            "TypesEnumTable" => "required|array",
            "TypesEnumTable.*" =>
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    return $query->where('key', SystemConstantsEnum::TypeEnumTable->value);
                }),
            "curriculumFrom" => ["required", "int", new Enum(MonthsEnum::class)],
            "curriculumTo" => ["required", "int", new Enum(MonthsEnum::class)],
            "ActiveEnum" => ["sometimes", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
