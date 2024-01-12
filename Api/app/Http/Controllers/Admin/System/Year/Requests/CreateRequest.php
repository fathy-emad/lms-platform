<?php

namespace App\Http\Controllers\Admin\System\Year\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use App\Enums\YearEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        $request = $this;
        return [
            "stage_id" => "required|integer|exists:stages,id",
            "YearEnum" => [
                "required",
                "string",
                new Enum(YearEnum::class),
                Rule::unique('years')->where(function ($query) use ($request) {
                    return $query->where([
                        'YearEnum' => $request->YearEnum,
                        'stage_id' => $request->stage_id
                    ]);
                })
            ],
            "ActiveEnum" => ["required", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
