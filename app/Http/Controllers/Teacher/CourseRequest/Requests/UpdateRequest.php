<?php

namespace App\Http\Controllers\Teacher\CourseRequest\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\TeacherCourseRequestStatusEnum;
use App\Models\CourseRequest;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            'id' => [
                "required",
                "integer",
                "exists:course_requests,id",
            ],

            "TeacherCourseRequestStatusEnum" => [
                "required",
                "string",
                "in:" . implode(",", TeacherCourseRequestStatusEnum::values()),
                function ($attribute, $value, $fail) {
                    $request = CourseRequest::find($this->id);
                    if ($request->TeacherCourseRequestStatusEnum->value != TeacherCourseRequestStatusEnum::Pending->value){
                        $fail("Sorry you can not update this record because this request already " . $request->TeacherCourseRequestStatusEnum->value);
                    }
                }
            ]
        ];
    }
}
