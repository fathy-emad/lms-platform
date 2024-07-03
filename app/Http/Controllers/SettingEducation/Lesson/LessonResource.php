<?php

namespace App\Http\Controllers\SettingEducation\Lesson;

use Illuminate\Http\Request;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\TranslationResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\SettingEducation\Chapter\ChapterResource;

class LessonResource extends JsonResource
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
                "id"         => $this->id,
                "chapter"    => new ChapterResource($this->chapter),
                "lesson"     => new TranslationResource($this->lessonTranslate),
                "priority"   => $this->priority,
            ],
            default => [
                "id"         => $this->id,
                "chapter"    => new ChapterResource($this->chapter),
                "lesson"     => new TranslationResource($this->lessonTranslate),
                "ActiveEnum" => new TranslationResource($this->ActiveEnum, true),
                "priority"   => $this->priority,
                "created_by" => new AuthorResource($this->createdBy),
                "updated_by" => $this->when($this->updatedBy, new AuthorResource($this->updatedBy), null),
                "created_at" => new DateTimeResource($this->created_at),
                "updated_at" => new DateTimeResource($this->updated_at)
            ]
        };

        return $return;
    }
}
