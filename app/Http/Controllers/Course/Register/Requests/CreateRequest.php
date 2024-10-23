<?php

namespace App\Http\Controllers\Course\Register\Requests;

use App\Enums\ActiveEnum;
use App\Concretes\ValidateRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "title" => "required|string|min:2",
            "description" => "required|string|min:2",
            "teacher_id" => "required|integer|exists:teachers,id",
            "curriculum_id" => [
                "required",
                "integer",
                "exists:curricula,id",
                Rule::unique("courses", "curriculum_id")->where(function ($query){
                    return $query->where("teacher_id", $this->teacher_id);
                })
            ],
            "cost" => "required|array",
            "cost.course" => "required|numeric",
            "cost.chapter" => "required|numeric",
            "cost.lesson" => "required|numeric",
            "video" => "required|string|min:4",
            "image.file" => "required|image",
            "image.title" => "nullable|string",
            "percentage" => "required|numeric",
            "ActiveEnum" => ["sometimes", "string", new Enum(ActiveEnum::class)],
            "IsFeatured" => ["sometimes", "string"],
        ];
    }
}
