<?php

namespace App\Http\Controllers\SettingEducation\Year\Requests;

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
            "id" => "required|integer|exists:years,id",
            "stage_id" => "required|integer|exists:stages,id",
            "YearEnumTable" => [
                "required",
                "integer",
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    return $query->where('key', SystemConstantsEnum::YearEnumTable->value);
                }),
                Rule::unique('years')->where(function ($query) {
                    return $query->where([
                        'YearEnumTable' => $this->YearEnumTable,
                        'stage_id' => $this->stage_id
                    ]);
                })->ignore($this->id)
            ],
            "ActiveEnum" => ["sometimes", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
