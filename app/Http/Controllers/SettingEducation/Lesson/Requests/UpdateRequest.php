<?php

namespace App\Http\Controllers\SettingEducation\Lesson\Requests;

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
            "id" => "required|integer|exists:lessons,id",
            "chapter_id" => "required|integer|exists:chapters,id",
            "lesson" => "required|array|min:1",
            "lesson.ar" =>  "required|string",
            "lesson.*" => "nullable|string",
            "ActiveEnum" => ["sometimes", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
