<?php

namespace App\Http\Controllers\Course\Register\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use App\Enums\AdminRoleEnum;
use App\Enums\AdminStatusEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Validator;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:courses,id",
            "title" => "required|array|min:1",
            "title.ar" =>  "required|string|regex:/^[\x{0600}-\x{06FF}\s\W]+$/u",
            "title.*" => "nullable|string",
            "description" => "required|array|min:1",
            "description.ar" =>  "required|string|regex:/^[\x{0600}-\x{06FF}\s\W]+$/u",
            "description.*" => "nullable|string",
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
            "video" => "required|string|min:4",
            "image.key" => [
                "nullable",
                "integer",
                Rule::exists("courses", "image->key")->where(function ($query){
                    return $query->where("id", $this->id);
                })
            ],
            "image.file" => "nullable|image",
            "image.title" => "nullable|string",
            "percentage" => "required|numeric",
            "ActiveEnum" => ["sometimes", "string", new Enum(ActiveEnum::class)],
        ];
    }


    /**
     * Configure the validator instance.
     *
     * @param Validator $validator
     * @return void
     */
    public function withValidator(Validator $validator): void
    {
        $validator->sometimes('image.file', 'required|image', function ($input) {
            return empty($input->image['key']);
        });
    }
}
