<?php

namespace App\Http\Controllers\SettingEducation\Curriculum\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
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
                    return $query->where('key', 'CurriculumEnumTable');
                }),
                Rule::unique('curricula')->where(function ($query) {
                    $query->where('CurriculumEnumTable', $this->CurriculumEnumTable)
                        ->where('subject_id', $this->subject_id);

                    if (!empty($this->TermsEnumTable) && is_array($this->TermsEnumTable)) {
                        foreach ($this->TermsEnumTable as $term) {
                            $query->whereJsonContains('TermsEnumTable', (string) $term);
                        }
                    }
                    if (!empty($this->TypesEnumTable) && is_array($this->TypesEnumTable)) {
                        foreach ($this->TypesEnumTable as $type) {
                            $query->whereJsonContains('TypesEnumTable', (string) $type);
                        }
                    }

                    return $query;
                })->ignore($this->id),
            ],
            "TermsEnumTable" => "required|array",
            "TermsEnumTable.*" =>
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    return $query->where('key', 'TermsEnumTable');
                }),
            "TypesEnumTable" => "required|array",
            "TypesEnumTable.*" =>
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    return $query->where('key', 'TypesEnumTable');
                }),
            "ActiveEnum" => ["required", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
