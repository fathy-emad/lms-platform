<?php

namespace App\Http\Controllers\Course\Register;

use App\Http\Controllers\Teacher\Register\RegisterResource;
use Illuminate\Http\Request;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\TranslationResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\SettingEducation\Curriculum\CurriculumResource;

class CourseResource extends JsonResource
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
                "title" => new TranslationResource($this->titleTranslate),
                "description" => new TranslationResource($this->descriptionTranslate),
                "stage" => new TranslationResource($this->curriculum->subject->year->stage->stageTranslate),
                "year" => new TranslationResource($this->curriculum->subject->year->yearTranslate),
                "subject" => new TranslationResource($this->curriculum->subject->subject->subjectTranslate),
                "curriculum" => new CurriculumResource($this->curriculum),
                "cost" => $this->cost,
                "percentage" => $this->percentage,
                "video" => $this->video,
                "image" => $this->image,
                "ActiveEnum" => new TranslationResource($this->ActiveEnum, true),
                "created_at" => new DateTimeResource($this->created_at),
                "updated_at" => new DateTimeResource($this->updated_at),
            ],
            default => [
                "id" => $this->id,
                "teacher" => new RegisterResource($this->teacher),
                "title" => new TranslationResource($this->titleTranslate),
                "description" => new TranslationResource($this->descriptionTranslate),
                "curriculum" => new CurriculumResource($this->curriculum),
                "cost" => $this->cost,
                "percentage" => $this->percentage,
                "video" => $this->video,
                "image" => $this->image,
                "ActiveEnum" => new TranslationResource($this->ActiveEnum, true),
                "created_by" => new AuthorResource($this->createdBy),
                "updated_by" => $this->when($this->updatedBy, new AuthorResource($this->updatedBy), null),
                "created_at" => new DateTimeResource($this->created_at),
                "updated_at" => new DateTimeResource($this->updated_at),
            ],
        };

        return $return;
    }
}
