<?php

namespace App\Http\Controllers\Teacher\CourseRequest;

use ApiResponse;
use App\Concretes\RequestHandler;
use App\Models\Course;
use App\Models\CourseRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CourseRequestHandler extends RequestHandler
{
    public function addNewCourse(): void
    {
        try {
            $data = CourseRequest::find($this->data["id"]);
            $curriculumID = $data["curriculum_id"];
            $teacherID = $data["teacher_id"];

            Course::create([
                "teacher_id" => $teacherID,
                "curriculum_id" => $curriculumID,
                "cost" => ["course" => 300 , "chapter" => 100, "lesson" => 50],
                "percentage" => 0.25,
                "ActiveEnum" => "notActive",
                "created_by" => auth("admin")->id()
            ]);


        } catch (\Exception $e) {
            throw new HttpResponseException(ApiResponse::sendError(["Course Request error" => [$e->getMessage()]], 'Course Request error please try again later', null));
        }
    }
}
