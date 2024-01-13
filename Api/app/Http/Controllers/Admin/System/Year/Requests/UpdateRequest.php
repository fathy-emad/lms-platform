<?php

namespace App\Http\Controllers\Admin\System\Year\Requests;

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
            "id" => "required|integer|exists:years,id",
            "stage_id" => "required|integer|exists:stages,id",
            "YearEnumTable" => [
                "required",
                "integer",
                "exists:enumerations,id",
                Rule::unique('years')->where(function ($query) use ($request) {
                    return $query->where([
                        'YearEnumTable' => $request->YearEnumTable,
                        'stage_id' => $request->stage_id
                    ]);
                })->ignore($request->id)
            ],
            "ActiveEnum" => ["required", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
