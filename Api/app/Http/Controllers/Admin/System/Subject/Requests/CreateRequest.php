<?php

namespace App\Http\Controllers\Admin\System\Subject\Requests;

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
            "year_id" => "required|integer|exists:years,id",
            "SubjectEnumTable" => [
                "required",
                "integer",
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    return $query->where('key', 'education_subjects');
                }),
                Rule::unique('subjects')->where(function ($query) use ($request) {
                    return $query->where([
                        'SubjectEnumTable' => $request->SubjectEnumTable,
                        'year_id' => $request->year_id
                    ]);
                })
            ],
            "ActiveEnum" => ["required", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
