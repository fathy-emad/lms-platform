<?php

namespace App\Http\Controllers\SettingEducation\Curriculum\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use App\Enums\SystemConstantsEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "subject_id" => "required|integer|exists:subjects,id",
            "CurriculumEnumTable" => [
                "required",
                "integer",
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    return $query->where('key', SystemConstantsEnum::CurriculumEnumTable->value);
                }),
                Rule::unique('curricula')->where(function ($query) {
                    $query->where('CurriculumEnumTable', $this->CurriculumEnumTable)->where('subject_id', $this->subject_id);
                    foreach ($this->TermsEnumTable as $term) $query->whereJsonContains('TermsEnumTable', (string) $term);
                    foreach ($this->TypesEnumTable as $type) $query->whereJsonContains('TypesEnumTable', (string) $type);
                    return $query;
                }),
            ],
            "TermsEnumTable" => "required|array|min:1",
            "TermsEnumTable.*" =>
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    return $query->where('key', SystemConstantsEnum::TermEnumTable->value);
                }),
            "TypesEnumTable" => "required|array|min:1",
            "TypesEnumTable.*" =>
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    return $query->where('key', SystemConstantsEnum::TypeEnumTable->value);
                }),
            "ActiveEnum" => ["sometimes", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
