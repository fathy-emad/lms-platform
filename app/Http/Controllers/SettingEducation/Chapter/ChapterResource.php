<?php

namespace App\Http\Controllers\SettingEducation\Chapter;

use App\Http\Controllers\Setting\Enumeration\EnumerationResource;
use App\Http\Controllers\SettingEducation\Curriculum\CurriculumResource;
use Illuminate\Http\Request;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\TranslationResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\SettingEducation\Branch\BranchResource;

class ChapterResource extends JsonResource
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
            "curriculum" => new CurriculumResource($this->curriculum),
            "chapter"    => new TranslationResource($this->chapterTranslate),
            "ActiveEnum" => new TranslationResource($this->ActiveEnum, true),
            "priority"   => $this->priority,
            "created_by" => new AuthorResource($this->createdBy),
            "updated_by" => $this->when($this->updatedBy, new AuthorResource($this->updatedBy), null),
            "created_at" => new DateTimeResource($this->created_at),
            "updated_at" => new DateTimeResource($this->updated_at)
        ];
    }
}
