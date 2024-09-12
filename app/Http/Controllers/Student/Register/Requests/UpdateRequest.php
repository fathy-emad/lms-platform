<?php

namespace App\Http\Controllers\Student\Register\Requests;

use App\Enums\GenderEnum;
use Illuminate\Validation\Rule;
use App\Concretes\ValidateRequest;
use Illuminate\Validation\Validator;
use Illuminate\Validation\Rules\Enum;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        if ($this->attributes->get("guard") == "admin")
            $ruleID = "required|integer|exists:students,id";
        else
            $ruleID = "required|integer|exists:students,id|in:" . auth("student")->id();

        return [
            "id" => $ruleID,
            "name" => "required|string|regex:/^[a-zA-Z0-9 .,?!\'’\"-]+$/u",
            "phone" => "required|digits:10|unique:students,phone,".$this->id,
            "email" => "required|email|unique:students,email,".$this->id,
            "national_id" => "nullable|digits:14|unique:students,".$this->id,
            "GenderEnum" => ["required", "string", new Enum(GenderEnum::class)],
            "country_id" => "required|exists:countries,id",
            "born" => "required|date_format:Y-m-d",
            "school" => "required|string",
            "image" => "nullable|array",
            "image.key" => [
                "nullable",
                "integer",
                Rule::exists("students", "image->key")->where(function ($query){
                    return $query->where("id", $this->id);
                })
            ],
            "image.file" => "nullable|image",
            "image.title" => "nullable|string",
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->sometimes('image.file', 'required|image', function ($input) {
            return empty($input->image['key']);
        });
    }
}
