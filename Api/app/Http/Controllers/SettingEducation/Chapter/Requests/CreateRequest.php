<?php

namespace App\Http\Controllers\SettingEducation\Chapter\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        $request = $this;
        return [
            "branch_id" => "required|integer|exists:branches,id",
            "ChapterEnumTable" => [
                "required",
                "integer",
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    return $query->where('key', 'education_chapters');
                }),
                Rule::unique('chapters')->where(function ($query) use ($request) {
                    return $query->where([
                        'ChapterEnumTable' => $request->ChapterEnumTable,
                        'branch_id' => $request->branch_id
                    ]);
                })
            ],
            "ActiveEnum" => ["required", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
