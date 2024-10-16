<?php

namespace App\Http\Controllers\SettingEducation\Stage\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use App\Enums\SystemConstantsEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|exists:stages,id",
            "country_id" => "required|integer|exists:countries,id",
            "stage" => "required|array|min:1",
            "stage.ar" =>  "required|string",
            "stage.*" => "nullable|string",
            "ActiveEnum" => ["sometimes", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
