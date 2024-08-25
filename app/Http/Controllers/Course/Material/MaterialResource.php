<?php

namespace App\Http\Controllers\Course\Material;

use App\Http\Controllers\Course\Register\CourseResource;
use App\Http\Controllers\SettingEducation\Curriculum\CurriculumResource;
use App\Http\Controllers\SettingEducation\Lesson\LessonResource;
use App\Http\Controllers\Teacher\BankQuestion\PaymentRequestResource;
use App\Http\Controllers\Teacher\Register\RegisterResource;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\TranslationResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $return = match ($request->attributes->get('guard')) {
            "teacher" => [
                "id" => $this->id,
                "course_id" => $this->course_id,
                "lesson_id" => $this->lesson_id,
                "lesson" => new TranslationResource($this->lesson->lessonTranslate),
                "chapter" => new TranslationResource($this->lesson->chapter->chapterTranslate),
                "course" => new TranslationResource($this->course->curriculum->curriculumTranslate),
                "description" => new TranslationResource($this->descriptionTranslate),
                "video" => $this->video,
                "video_duration" => $this->video_duration,
                "images" => $this->images,
                "files" => $this->files,
                //"questions" => BankQuestionResource::collection($this->duty),
                "assignment" => $this->assignment,
                "ActiveEnum" => new TranslationResource($this->ActiveEnum, true),
                "FreeEnum" => new TranslationResource($this->FreeEnum, true),
                "created_at" => new DateTimeResource($this->created_at),
                "updated_at" => new DateTimeResource($this->updated_at),
            ],
            default => [
                "id" => $this->id,
                "course_id" => $this->course_id,
                "lesson" => new LessonResource($this->lesson),
                "description" => new TranslationResource($this->descriptionTranslate),
                "video" => $this->video,
                "video_duration" => $this->video_duration,
                "images" => $this->images,
                "files" => $this->files,
                //"questions" => BankQuestionResource::collection($this->duty),
                "assignment" => $this->assignment,
                "ActiveEnum" => new TranslationResource($this->ActiveEnum, true),
                "FreeEnum" => new TranslationResource($this->FreeEnum, true),
                "created_at" => new DateTimeResource($this->created_at),
                "updated_at" => new DateTimeResource($this->updated_at),
            ],
        };

        return $return;
    }
}
