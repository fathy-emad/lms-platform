<?php

namespace App\Http\Controllers\Admin\System\Subject\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use App\Enums\SubjectEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        $request = $this;
        return [
            "year_id" => "required|integer|exists:years,id",
            "SubjectEnum" => [
                "required",
                "string",
                new Enum(SubjectEnum::class),
                Rule::unique('subjects')->where(function ($query) use ($request) {
                    return $query->where([
                        'SubjectEnum' => $request->SubjectEnum,
                        'year_id' => $request->year_id
                    ]);
                })
            ],
            "terms" => "required|boolean",
            "ActiveEnum" => ["required", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
