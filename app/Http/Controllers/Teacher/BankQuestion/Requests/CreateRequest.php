<?php

namespace App\Http\Controllers\Teacher\BankQuestion\Requests;

use App\Enums\ActiveEnum;
use App\Enums\QuestionTypeEnum;
use App\Concretes\ValidateRequest;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            'teacher_id' => 'nullable|integer|exists:teachers,id',
            'lesson_id' => 'required|integer|exists:lessons,id',
            'question' => 'required|string|min:2',
            'answers' => 'required|array|min:3',
            'answers.*' => 'required|string',
            'correctAnswer' => 'required|string',
            'images.*.file' => 'nullable|image',
            'images.*.title' => 'nullable|string',
            'QuestionTypeEnum' => "required|in:".implode(",", QuestionTypeEnum::values()),
            "ActiveEnum" => "sometimes|in:".implode(",", ActiveEnum::values()),
        ];
    }
}
