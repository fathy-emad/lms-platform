<?php

namespace App\Http\Controllers\Course\Register\Requests;

use App\Enums\ActiveEnum;
use App\Concretes\ValidateRequest;
use Illuminate\Validation\Rules\Enum;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "curriculum_id" => "required|integer|exists:curricula,id",
            "teacher_id" => "required|integer|exists:teachers,id",
            "costs" => "required|array",
            "costs.course" => "required|integer",
            "costs.branch" => "required|integer",
            "costs.chapter" => "required|integer",
            "costs.lesson" => "required|integer",
            "ActiveEnum" => ["required", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
