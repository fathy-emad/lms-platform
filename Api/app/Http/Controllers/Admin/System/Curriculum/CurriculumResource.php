<?php

namespace App\Http\Controllers\Admin\System\Curriculum;

use App\Http\Controllers\Admin\System\Subject\SubjectResource;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\TranslationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            "id" => $this->id,
            "subject" => new SubjectResource($this->subject),
            "CurriculumEnumTable" => new TranslationResource($this->curriculumEnum->valueTranslate),
            "TermsEnumTable" => $this->TermsEnum,
            "TypesEnumTable" => $this->TypesEnum,
            "ActiveEnum" =>  new TranslationResource($this->ActiveEnum, true),
            "created_by" => new AuthorResource($this->createdBy),
            "updated_by" => $this->updated_by ? new AuthorResource($this->updatedBy) : null,
            "created_at" => new DateTimeResource($this->created_at),
            "updated_at" => new DateTimeResource($this->updated_at)
        ];
    }
}
