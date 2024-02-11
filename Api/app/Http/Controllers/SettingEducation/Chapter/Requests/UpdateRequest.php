<?php

namespace App\Http\Controllers\SettingEducation\Chapter\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:chapters,id",
            "branch_id" => "required|integer|exists:branches,id",
            "ChapterEnumTable" => [
                "required",
                "integer",
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    return $query->where('key', 'ChapterEnumTable');
                }),
                Rule::unique('chapters')->where(function ($query) {
                    return $query->where([
                        'ChapterEnumTable' => $this->ChapterEnumTable,
                        'branch_id' => $this->branch_id
                    ]);
                })->ignore($this->id)
            ],
            "ActiveEnum" => ["required", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
