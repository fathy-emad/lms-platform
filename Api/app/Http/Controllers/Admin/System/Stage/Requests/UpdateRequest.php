<?php

namespace App\Http\Controllers\Admin\System\Stage\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use App\Enums\StageEnum;
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
            "StageEnum" => [
                "required",
                "string",
                new Enum(StageEnum::class),
                Rule::unique('stages')->where(function ($query) use ($request) {
                    return $query->where([
                        'StageEnum' => $request->StageEnum,
                        'country_id' => $request->country_id
                    ]);
                })->ignore($request->id)
            ],
            "ActiveEnum" => ["required", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
