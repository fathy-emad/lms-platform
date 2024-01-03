<?php

namespace App\Http\Controllers\Admin\Settings\Language;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
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
            "locale" => $this->locale,
            "language" => $this->languageTranslate->translates[app()->getLocale()],
            "flag" => $this->flag,
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
