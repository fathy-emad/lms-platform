<?php

namespace App\Http\Controllers\SettingEducation\Chapter\Requests;

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
            "branch_id" => "required|integer|exists:branches,id",
            "ChapterEnumTable" => [
                "required",
                "integer",
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    return $query->where('key', SystemConstantsEnum::ChapterEnumTable->value);
                }),
                Rule::unique('chapters')->where(function ($query) {
                    return $query->where([
                        'ChapterEnumTable' => $this->ChapterEnumTable,
                        'branch_id' => $this->branch_id
                    ]);
                })
            ],
            "ActiveEnum" => ["sometimes", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
