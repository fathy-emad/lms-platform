<?php

namespace App\Http\Controllers\Course\Material;

use App\Http\Controllers\Course\Register\CourseResource;
use App\Http\Controllers\SettingEducation\Curriculum\CurriculumResource;
use App\Http\Controllers\SettingEducation\Lesson\LessonResource;
use App\Http\Controllers\Teacher\BankQuestion\BankQuestionResource;
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
        return [
            "id" => $this->id,
            "course_id" => $this->course_id,
            "lesson" => new LessonResource($this->lesson),
            "description" => new TranslationResource($this->descriptionTranslate),
            "video" => $this->video,
            "images" => $this->images,
            "files" => $this->files,
            //"questions" => BankQuestionResource::collection($this->duty),
            "assignment" => $this->assignment,
            "ActiveEnum" => new TranslationResource($this->ActiveEnum, true),
            "FreeEnum" => new TranslationResource($this->FreeEnum, true),
            "created_at" => new DateTimeResource($this->created_at),
            "updated_at" => new DateTimeResource($this->updated_at),
        ];
    }
}
