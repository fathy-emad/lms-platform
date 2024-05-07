<?php

namespace App\Http\Controllers\SettingEducation\Stage;

use Illuminate\Http\Request;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\TranslationResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\Setting\Country\CountryResource;
use App\Http\Controllers\Setting\Enumeration\EnumerationResource;

class StageResource extends JsonResource
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
            "country"       => new CountryResource($this->country),
            "title"         => new EnumerationResource($this->stageEnum),
            "ActiveEnum"    => new TranslationResource($this->ActiveEnum, true),
            "created_by"    => new AuthorResource($this->createdBy),
            "updated_by"    => $this->updated_by ? new AuthorResource($this->updatedBy) : null,
            "created_at"    => new DateTimeResource($this->created_at),
            "updated_at"    => new DateTimeResource($this->updated_at),
        ];
    }
}
