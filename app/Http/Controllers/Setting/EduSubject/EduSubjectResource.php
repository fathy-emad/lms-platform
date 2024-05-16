<?php

namespace App\Http\Controllers\Setting\EduSubject;

use Illuminate\Http\Request;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\TranslationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EduSubjectResource extends JsonResource
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
            "subject" => new TranslationResource($this->subjectTranslate),
            "created_by" => new AuthorResource($this->createdBy),
            "updated_by" => $this->when($this->updatedBy, new AuthorResource($this->updatedBy), null),
            "created_at" => new DateTimeResource($this->created_at),
            "updated_at" => new DateTimeResource($this->updated_at),
        ];
    }
}
