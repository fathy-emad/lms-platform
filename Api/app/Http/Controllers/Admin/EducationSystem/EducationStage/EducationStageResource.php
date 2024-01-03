<?php

namespace App\Http\Controllers\Admin\EducationSystem\EducationStage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationStageResource extends JsonResource
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
            "country_id" => $this->country_id,
            "country" => $this->country->countryTranslate->translates[app()->getLocale()],
            "EducationStageEnum" => [
                'key' => $this->EducationStageEnum->value,
                'translation' => $this->EducationStageEnum->title()
            ],
            "ActiveEnum" => [
                'key' => $this->ActiveEnum->value,
                'translation' => $this->ActiveEnum->title()
            ],
            "created_by" => $this->createdBy->name ?? null,
            "created_at" => $this->created_at,
            "updated_by" => $this->updatedBy->name ?? null,
            "updated_at" => $this->updated_at,
        ];
    }
}
