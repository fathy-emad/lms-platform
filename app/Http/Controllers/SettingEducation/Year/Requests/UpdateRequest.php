<?php

namespace App\Http\Controllers\SettingEducation\Year\Requests;

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
            "id" => "required|integer|exists:years,id",
            "stage_id" => "required|integer|exists:stages,id",
            "year" => "required|array|min:1",
            "year.ar" => "required|string|regex:/^[\x{0600}-\x{06FF}\s]+$/u",
            "year.*" => "nullable|string",
            "ActiveEnum" => ["sometimes", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
