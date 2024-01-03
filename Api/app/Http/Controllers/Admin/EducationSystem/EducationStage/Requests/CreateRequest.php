<?php

namespace App\Http\Controllers\Admin\EducationSystem\EducationStage\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use App\Enums\EducationStageEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        $request = $this;
        return [
            "country_id" => "required|integer|exists:countries,id",
            "EducationStageEnum" => [
                "required",
                "string",
                new Enum(EducationStageEnum::class),
                Rule::unique('education_stages')->where(function ($query) use ($request) {
                    return $query->where([
                        'EducationStageEnum' => $request->EducationStageEnum,
                        'country_id' => $request->country_id
                    ]);
                })
            ],
            "ActiveEnum" => ["required", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
