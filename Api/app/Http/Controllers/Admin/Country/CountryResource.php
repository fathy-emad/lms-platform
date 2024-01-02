<?php

namespace App\Http\Controllers\Admin\Country;

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
            "country" => $this->countryTranslate->translates[app()->getLocale()],
            "phone_prefix" => $this->phone_prefix,
            "timezone" => $this->timezone,
            "currency" => $this->currencyTranslate->translates[app()->getLocale()],
            "currency_symbol" => $this->currency_symbol,
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
