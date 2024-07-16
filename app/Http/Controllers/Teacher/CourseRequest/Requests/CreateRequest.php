<?php

namespace App\Http\Controllers\Teacher\CourseRequest\Requests;

use Illuminate\Validation\Rule;
use App\Concretes\ValidateRequest;
use App\Enums\TeacherCourseRequestStatusEnum;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            'teacher_id' => [
                'required',
                'integer',
                'exists:teachers,id',
                'in:'.auth('teacher')->id(),
            ],

            "curriculum_id" => [
                "required",
                "integer",
                "exists:curricula,id",
                Rule::unique('courses', 'curriculum_id')->where(fn($query) => $query->where('teacher_id', $this->teacher_id)),
                Rule::unique('course_requests', 'curriculum_id')->where(function($query){
                    return $query->where("teacher_id", $this->teacher_id)->whereIn("TeacherCourseRequestStatusEnum", [
                        TeacherCourseRequestStatusEnum::Pending->value,
                        TeacherCourseRequestStatusEnum::Approved->value
                    ]);
                }),
            ],
        ];
    }
}
