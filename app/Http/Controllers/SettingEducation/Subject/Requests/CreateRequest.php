<?php

namespace App\Http\Controllers\SettingEducation\Subject\Requests;

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
            "year_id" => "required|integer|exists:years,id",
            "SubjectEnumTable" => [
                "required",
                "integer",
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    return $query->where('key', SystemConstantsEnum::SubjectEnumTable->value);
                }),
                Rule::unique('subjects')->where(function ($query) {
                    return $query->where([
                        'SubjectEnumTable' => $this->SubjectEnumTable,
                        'year_id' => $this->year_id
                    ]);
                })
            ],
            "ActiveEnum" => ["sometimes", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
