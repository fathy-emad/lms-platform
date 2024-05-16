<?php

namespace App\Http\Controllers\SettingEducation\Subject;

use Illuminate\Http\Request;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\TranslationResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\Setting\Enumeration\EnumerationResource;
use App\Http\Controllers\SettingEducation\Year\YearResource;

class SubjectResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"                => $this->id,
            "year"              => new YearResource($this->year),
            "edu_subject_id"    => $this->edu_subject_id,
            "subject"           => new TranslationResource($this->subject->subjectTranslate),
            "ActiveEnum"        => new TranslationResource($this->ActiveEnum, true),
            "created_by"        => new AuthorResource($this->createdBy),
            "updated_by"        => $this->updated_by ? new AuthorResource($this->updatedBy) : null,
            "created_at"        => new DateTimeResource($this->created_at),
            "updated_at"        => new DateTimeResource($this->updated_at)
        ];
    }
}
