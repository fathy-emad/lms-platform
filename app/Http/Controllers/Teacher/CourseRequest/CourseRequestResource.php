<?php

namespace App\Http\Controllers\Teacher\CourseRequest;

use Illuminate\Http\Request;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\TranslationResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\Teacher\Register\RegisterResource;
use App\Http\Controllers\SettingEducation\Curriculum\CurriculumResource;

class CourseRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "teacher" => new RegisterResource($this->teacher),
            "curriculum" => new CurriculumResource($this->curriculum),
            "TeacherCourseRequestStatusEnum" => new TranslationResource($this->TeacherCourseRequestStatusEnum, true),
            "created_at" => new DateTimeResource($this->created_at),
            "updated_at" => new DateTimeResource($this->updated_at),
        ];
    }
}
