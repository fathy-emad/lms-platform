<?php

namespace App\Http\Controllers\Setting\FAQ\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:faqs,id",
            "question" => "required|array",
            "question.ar" => "required|string|regex:/^[\x{0600}-\x{06FF}\s]+$/u",
            "question.*" => "nullable|string",
            "answer" => "required|array",
            "answer.ar" => "required|string",
            "answer.*" => "nullable|string",
            "ActiveEnum" => "sometimes|in:".implode(",", ActiveEnum::values()),
        ];
    }
}
