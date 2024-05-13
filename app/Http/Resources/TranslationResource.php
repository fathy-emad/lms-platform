<?php

namespace App\Http\Resources;

use Translation;
use App\Models\Translate;
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
                "translate" => $this->title(),
                "translates" => $this->translates()
            ];
        }

        if (array_key_exists(app()->getLocale(), $this->translates)){
            $translate = $this->translates[app()->getLocale()];
            $translates = $this->translates;

        } else if ($id = Translation::translate($this->field, $this->table, $this->translates, $this->id)) {
            $translation = Translate::find($id);
            $translate = $translation->translates[app()->getLocale()];
            $translates = $translation->translates;

        } else {
            $translate = $this->translates["ar"];
            $translates = $this->translates;
        }

        return [
            "key" => $this->key,
            "translate" => $translate,
            "translates" => $translates
        ];
    }
}
