<?php

namespace App\Http\Controllers\Course\Register\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use App\Enums\AdminRoleEnum;
use App\Enums\AdminStatusEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:courses,id",
            "teacher_id" => "required|integer|exists:teachers,id",
            "curriculum_id" => [
                "required",
                "integer",
                "exists:curricula,id",
                Rule::unique("courses", "curriculum_id")->where(function ($query){
                    return $query->where("teacher_id", $this->teacher_id);
                })->ignore($this->id)
            ],
            "cost" => "required|array",
            "cost.course" => "required|numeric",
            "cost.chapter" => "required|numeric",
            "cost.lesson" => "required|numeric",
            "percentage" => "required|numeric",
            "ActiveEnum" => ["sometimes", "string", new Enum(ActiveEnum::class)],
        ];
    }
}
