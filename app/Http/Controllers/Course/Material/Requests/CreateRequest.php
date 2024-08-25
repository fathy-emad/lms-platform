<?php

namespace App\Http\Controllers\Course\Material\Requests;

use App\Enums\FreeEnum;
use App\Enums\ActiveEnum;
use App\Concretes\ValidateRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends ValidateRequest
{

    public function rules(): array
    {

        return [
            'course_id' => 'required|integer|exists:courses,id',
            'lesson_id' => [
                'required',
                'integer',
                'exists:lessons,id',
                Rule::unique("materials", "lesson_id")
                    ->where(fn($query) => $query->where("course_id", $this->course_id))
            ],
            'description' => 'required|string|min:2',
            'video' => 'required|string',
            'video_duration' => 'required|integer',
            'images.*.file' => 'nullable|image',
            'images.*.title' => 'nullable|string',
            'files.*.file' => 'nullable|mimes:pdf,doc,docx,txt,ppt,pptx',
            'files.*.title' => 'nullable|string',
            'assignment' => 'required|array|min:1',
            'assignment.*' => 'required|integer|exists:bank_questions,id',
            'FreeEnum' => "sometimes|in:".implode(",", FreeEnum::values()),
            "ActiveEnum" => "sometimes|in:".implode(",", ActiveEnum::values()),
        ];
    }
}
