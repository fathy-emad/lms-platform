<?php

namespace App\Http\Controllers\Admin\System\Lesson;

use App\Http\Resources\AuthorResource;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\TranslationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"         => $this->id,
            "chapter" => new TranslationResource($this->chapter->chapterEnum->valueTranslate),
            "lesson"     => new TranslationResource($this->lessonEnum->valueTranslate),
            "ActiveEnum" => new TranslationResource($this->ActiveEnum, true),
            "priority"   => $this->priority,
            "created_by" => new AuthorResource($this->createdBy),
            "updated_by" => $this->updated_by ? new AuthorResource($this->updatedBy) : null,
            "created_at" => new DateTimeResource($this->created_at),
            "updated_at" => new DateTimeResource($this->updated_at)
        ];
    }
}
