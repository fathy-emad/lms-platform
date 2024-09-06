<?php

namespace App\Http\Controllers\Teacher\Register\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use App\Enums\GenderEnum;
use App\Enums\NamePrefixEnum;
use App\Enums\TeacherStatusEnum;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Validator;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        if ($this->attributes->get("guard") == "admin")
            $ruleID = "required|integer|exists:teachers,id";
        else
            $ruleID = "required|integer|exists:teachers,id|in:" . auth("teacher")->id();

        return [
            "id" => $ruleID,
            "prefix" => ["required", "string", new Enum(NamePrefixEnum::class)],
            "name" => "required|string|regex:/^[a-zA-Z0-9 .,?!\'’\"-]+$/u",
            "phone" => "required|digits:10|unique:teachers,phone," . $this->id,
            "email" => "sometimes|email|unique:teachers,email," . $this->id,
            "national_id" => "nullable|digits:14|unique:admins,national_id," . $this->id,
            "GenderEnum" => ["required", "string", new Enum(GenderEnum::class)],
            "TeacherStatusEnum" => ["sometimes", "string", new Enum(TeacherStatusEnum::class)],
            "block_reason" => "required_if:TeacherStatusEnum," . TeacherStatusEnum::Blocked->value,
            "country_id" => "sometimes|exists:countries,id",
            "stage_id" => "required|exists:stages,id",
            "edu_subject_id" => [
                "required",
                "exists:edu_subjects,id",
                //if change stage or subject, and he has courses prevent this action and tell him create new account
                function ($attribute, $value, $fail) {
                    $teacher = Teacher::find($this->id);
                    $courses = Course::where("teacher_id", $this->id)->exists();

                    if ($courses && ($this->stage_id != $teacher->stage_id || $this->edu_subject_id != $teacher->edu_subject_id))
                        $fail("You can not change your stage or subject because you have course in this account please have a new account");
                }
            ],
            "bio" => "nullable|string",
            "image" => "nullable|array",
            "image.key" => [
                "nullable",
                "integer",
                Rule::exists("teachers", "image->key")->where(function ($query){
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
