<?php

namespace App\Http\Controllers\SettingEducation\Lesson\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:lessons,id",
            "chapter_id" => "required|integer|exists:chapters,id",
            "LessonEnumTable" => [
                "required",
                "integer",
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    return $query->where('key', 'LessonEnumTable');
                }),
                Rule::unique('chapters')->where(function ($query) {
                    return $query->where([
                        'LessonEnumTable' => $this->LessonEnumTable,
                        'chapter_id' => $this->chapter_id
                    ]);
                })->ignore($this->id)
            ],
            "ActiveEnum" => ["required", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
