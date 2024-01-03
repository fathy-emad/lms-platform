<?php

namespace App\Traits;

use App\Models\Language;
use App\Models\Translate;

trait TranslationTrait
{
    public function translate(string $filed, string $table, array $data, ?int $id): int
    {
        $languages = Language::all();
        if ($languages->count() < 2)
        {
            $languages = [
                ["locale" => "ar"],
                ["locale" => "en"]
            ];
        }

        else
        {
            $languages = $languages->toArray();
        }

        $data = $this->handleTranslate($filed, $table, $data, $languages);

        if (!isset($id)){

            return $this->createTranslate($data);

        } else {

            return $this->updateTranslate($data, $id);
        }
    }

    public function handleTranslate(string $field, string $table, array $data, $languages): array
    {
        $translates = [];
        foreach ($languages AS $lang) {
            $translates[$lang["locale"]] = $data[$lang["locale"]] ?? $data["en"];
        }

        return [
            "field" => $field,
            "table" => $table,
            "key" => $translates["en"],
            "translates" => $translates
        ];
    }

    public function createTranslate(array $data): int
    {
        $translate = Translate::create($data);
        return $translate->id;
    }

    public function updateTranslate(array $data, int $id): int
    {
        $translate = Translate::find($id);
        $translate->update($data);
        return $translate->id;
    }
}
