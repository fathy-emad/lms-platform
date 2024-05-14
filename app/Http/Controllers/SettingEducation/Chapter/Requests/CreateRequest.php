<?php

namespace App\Http\Controllers\SettingEducation\Chapter\Requests;

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
            "curriculum_id" => "required|integer|exists:curricula,id",
            "chapter" => ["required","string", "min:2"],
            "ActiveEnum" => ["sometimes", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
