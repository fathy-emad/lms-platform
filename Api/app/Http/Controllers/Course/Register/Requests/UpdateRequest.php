<?php

namespace App\Http\Controllers\Course\Register\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use App\Enums\AdminRoleEnum;
use App\Enums\AdminStatusEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:courses,id",
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
