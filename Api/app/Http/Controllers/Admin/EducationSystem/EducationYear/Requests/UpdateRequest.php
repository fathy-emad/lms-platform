<?php

namespace App\Http\Controllers\Admin\EducationSystem\EducationYear\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use App\Enums\EducationYearEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        $request = $this;
        return [
            "id" => "required|integer|exists:education_years,id",
            "stage_id" => "required|integer|exists:education_stages,id",
            "EducationYearEnum" => [
                "required",
                "string",
                new Enum(EducationYearEnum::class),
                Rule::unique('education_years')->where(function ($query) use ($request) {
                    return $query->where([
                        'EducationYearEnum' => $request->EducationYearEnum,
                        'stage_id' => $request->stage_id
                    ]);
                })->ignore($request->id)
            ],
            "ActiveEnum" => ["required", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
