<?php

namespace App\Http\Controllers\Setting\FAQ;

use App\Http\Resources\AuthorResource;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\TranslationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FAQResource extends JsonResource
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
            "question" => new TranslationResource($this->questionTranslate),
            "answer" => new TranslationResource($this->answerTranslate),
            "ActiveEnum" => new TranslationResource($this->ActiveEnum, true),
            "created_at" => new DateTimeResource($this->created_at),
            "updated_at" => new DateTimeResource($this->updated_at),
            "created_by" => new AuthorResource($this->createdBy),
            "updated_by" => $this->when($this->updatedBy, new AuthorResource($this->updatedBy), null),
        ];
    }
}
