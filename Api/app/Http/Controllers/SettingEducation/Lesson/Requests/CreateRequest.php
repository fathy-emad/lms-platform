<?php

namespace App\Http\Controllers\SettingEducation\Lesson\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        $request = $this;
        return [
            "chapter_id" => "required|integer|exists:chapters,id",
            "LessonEnumTable" => [
                "required",
                "integer",
                Rule::exists('enumerations', 'id')->where(function ($query) {
                    return $query->where('key', 'education_lessons');
                }),
                Rule::unique('lessons')->where(function ($query) use ($request) {
                    return $query->where([
                        'LessonEnumTable' => $request->LessonEnumTable,
                        'chapter_id' => $request->chapter_id
                    ]);
                })
            ],
            "ActiveEnum" => ["required", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
