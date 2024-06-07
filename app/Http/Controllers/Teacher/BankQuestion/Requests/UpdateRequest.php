<?php

namespace App\Http\Controllers\Teacher\BankQuestion\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use App\Enums\GenderEnum;
use App\Enums\NamePrefixEnum;
use App\Enums\QuestionTypeEnum;
use App\Enums\TeacherStatusEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Validator;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:bank_questions,id',
            'teacher_id' => 'nullable|integer|exists:teachers,id',
            'lesson_id' => 'required|integer|exists:lessons,id',
            'question' => 'required|string|min:2',
            'answers' => 'required|array|min:3',
            'answers.*' => 'required|string',
            'correctAnswer' => 'required|string',
            'images' => 'nullable|array',
            "images.*.key" => "nullable|integer",
            'images.*.file' => "nullable|image",
            'images.*.title' => 'nullable|string',
            'QuestionTypeEnum' => "required|in:".implode(",", QuestionTypeEnum::values()),
            "ActiveEnum" => "sometimes|in:".implode(",", ActiveEnum::values()),
        ];
    }
}
