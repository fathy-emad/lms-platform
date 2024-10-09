<?php

namespace App\Http\Controllers\SettingEducation\Chapter\Requests;

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
            "id" => "required|integer|exists:chapters,id",
            "curriculum_id" => "required|integer|exists:curricula,id",
            "chapter" => "required|array|min:1",
            "chapter.ar" => "required|string|regex:/^[\x{0600}-\x{06FF}\s\W]+$/u",
            "chapter.*" => "nullable|string",
            "ActiveEnum" => ["sometimes", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
