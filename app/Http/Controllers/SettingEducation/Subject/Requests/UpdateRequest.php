<?php

namespace App\Http\Controllers\SettingEducation\Subject\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:subjects,id",
            "year_id" => "required|integer|exists:years,id",
            "SubjectEnumTable" => [
                "required",
                "integer",
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    return $query->where('key', 'SubjectEnumTable');
                }),
                Rule::unique('subjects')->where(function ($query) {
                    return $query->where([
                        'SubjectEnumTable' => $this->SubjectEnumTable,
                        'year_id' => $this->year_id
                    ]);
                })->ignore($this->id)
            ],
            "ActiveEnum" => ["required", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
