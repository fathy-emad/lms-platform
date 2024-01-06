<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TranslationResource extends JsonResource
{
    protected bool $isEnum;

    public function __construct($resource, $isEnum = false)
    {
        parent::__construct($resource);
        $this->isEnum = $isEnum;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->isEnum)
        {
            return [
                "key" => $this->value,
                "translate" => $this->title()
            ];
        }

        return [
            "key" => $this->key,
            "translate" => $this->translates[app()->getLocale()]
        ];
    }
}
