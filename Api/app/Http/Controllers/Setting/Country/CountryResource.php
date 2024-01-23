<?php

namespace App\Http\Controllers\Setting\Country;

use App\Http\Resources\AuthorResource;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\TranslationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            "symbol" => $this->symbol,
            "country" => new TranslationResource($this->countryTranslate),
            "phone_prefix" => $this->phone_prefix,
            "timezone" => $this->timezone,
            "currency" => new TranslationResource($this->currencyTranslate),
            "currency_symbol" => $this->currency_symbol,
            "flag" => $this->flag,
            "ActiveEnum" => new TranslationResource($this->ActiveEnum, true),
            "created_by" => new AuthorResource($this->createdBy),
            "updated_by" => $this->updated_by ? new AuthorResource($this->updatedBy) : null,
            "created_at" => new DateTimeResource($this->created_at),
            "updated_at" => new DateTimeResource($this->updated_at),
        ];
    }
}
