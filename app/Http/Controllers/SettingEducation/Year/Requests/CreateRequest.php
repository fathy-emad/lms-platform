<?php

namespace App\Http\Controllers\SettingEducation\Year\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use App\Enums\SystemConstantsEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "stage_id" => "required|integer|exists:stages,id",
            "year" => "required|string|min:2",
            "image.file" => "required|image",
            "image.title" => "nullable|string",
            "ActiveEnum" => ["sometimes", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
