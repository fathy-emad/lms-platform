<?php

namespace App\Http\Controllers\SettingEducation\Lesson;

use App\Http\Controllers\Setting\Enumeration\EnumerationResource;
use App\Http\Controllers\SettingEducation\Chapter\ChapterResource;
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
            "chapter"    => new ChapterResource($this->chapter->chapter),
            "title"      => new EnumerationResource($this->lessonEnum),
            "ActiveEnum" => new TranslationResource($this->ActiveEnum, true),
            "priority"   => $this->priority,
            "created_by" => new AuthorResource($this->createdBy),
            "updated_by" => $this->updated_by ? new AuthorResource($this->updatedBy) : null,
            "created_at" => new DateTimeResource($this->created_at),
            "updated_at" => new DateTimeResource($this->updated_at)
        ];
    }
}
