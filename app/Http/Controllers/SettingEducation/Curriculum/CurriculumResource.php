<?php

namespace App\Http\Controllers\SettingEducation\Curriculum;

use Illuminate\Http\Request;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\TranslationResource;
use Illuminate\Http\Resources\Json\JsonResource;
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
            "id"            => $this->id,
            "subject"       => new SubjectResource($this->subject),
            "curriculum"    => new TranslationResource($this->curriculumTranslate),
            "EduTermsEnums" => $this->EduTermsEnums->map(fn($enum) => new TranslationResource($enum, true)),
            "EduTypesEnums" =>  $this->EduTypesEnums->map(fn($enum) => new TranslationResource($enum, true)),
            "from"          => new TranslationResource($this->from, true),
            "to"            => new TranslationResource($this->to, true),
            "ActiveEnum"    => new TranslationResource($this->ActiveEnum, true),
            "created_by"    => new AuthorResource($this->createdBy),
            "updated_by"    => $this->updated_by ? new AuthorResource($this->updatedBy) : null,
            "created_at"    => new DateTimeResource($this->created_at),
            "updated_at"    => new DateTimeResource($this->updated_at)
        ];
    }
}
