<?php

namespace App\Http\Controllers\SettingEducation\Branch\Requests;

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
            "curriculum_id" => "required|integer|exists:curricula,id",
            "BranchEnumTable" => [
                "required",
                "integer",
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    return $query->where('key', 'education_branches');
                }),
                Rule::unique('branches')->where(function ($query) use ($request) {
                    return $query->where([
                        'BranchEnumTable' => $request->BranchEnumTable,
                        'curriculum_id' => $request->curriculum_id
                    ]);
                })
            ],
            "ActiveEnum" => ["required", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
