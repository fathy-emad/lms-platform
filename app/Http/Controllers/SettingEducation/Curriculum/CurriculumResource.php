<?php

namespace App\Http\Controllers\SettingEducation\Curriculum;

use Illuminate\Http\Request;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\TranslationResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\Setting\Enumeration\EnumerationResource;
use App\Http\Controllers\SettingEducation\Subject\SubjectResource;

class CurriculumResource extends JsonResource
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
            "subject"           => new SubjectResource($this->subject),
            "title"             => new EnumerationResource($this->curriculumEnum),
            "terms"             => EnumerationResource::collection($this->TermsEnums),
            "types"             => EnumerationResource::collection($this->TypesEnums),
            "curriculumFrom"    => new TranslationResource($this->curriculumFrom, true),
            "curriculumTo"      => new TranslationResource($this->curriculumTo, true),
            "ActiveEnum"        => new TranslationResource($this->ActiveEnum, true),
            "created_by"        => new AuthorResource($this->createdBy),
            "updated_by"        => $this->updated_by ? new AuthorResource($this->updatedBy) : null,
            "created_at"        => new DateTimeResource($this->created_at),
            "updated_at"        => new DateTimeResource($this->updated_at)
        ];
    }
}
