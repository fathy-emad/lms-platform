<?php

namespace App\Http\Controllers\SettingEducation\Stage\Requests;

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
            "id" => "required|exists:stages,id",
            "country_id" => "required|integer|exists:countries,id",
            "StageEnumTable" => [
                "required",
                "integer",
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    return $query->where('key', SystemConstantsEnum::StageEnumTable->value);
                }),
                Rule::unique('stages')->where(function ($query) {
                    return $query->where([
                        'StageEnumTable' => $this->StageEnumTable,
                        'country_id' => $this->country_id
                    ]);
                })->ignore($this->id)
            ],
            "ActiveEnum" => ["sometimes", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
