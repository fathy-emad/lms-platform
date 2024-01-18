<?php

namespace App\Http\Controllers\Admin\System\Stage\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        $request = $this;
        return [
            "id" => "required|exists:stages",
            "country_id" => "required|integer|exists:countries,id",
            "StageEnumTable" => [
                "required",
                "integer",
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    return $query->where('key', 'education_stages');
                }),
                Rule::unique('stages')->where(function ($query) use ($request) {
                    return $query->where([
                        'StageEnumTable' => $request->StageEnumTable,
                        'country_id' => $request->country_id
                    ]);
                })->ignore($request->id)
            ],
            "ActiveEnum" => ["required", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
