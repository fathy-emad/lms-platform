<?php

namespace App\Traits;

use App\Models\Language;
use App\Models\Translate;

trait TranslationTrait
{
    public function translate(array $data, ?int $id): int
    {
        $languages = Language::all();
        $data = $this->handleTranslate($data, $languages ?? []);

        if (!isset($id)){
            $data = $this->handleDataCreate($data);
            return $this->createTranslate($data);

        } else {
            $data = $this->handleDataUpdate($data);
            return $this->updateTranslate($data, $id);
        }
    }

    public function handleTranslate(array $data, $languages): array
    {
        $translates = [];

        foreach ($languages AS $lang) {
            $translates[$lang->locale] = $data[$lang->locale] ?? $data["en"];
        }

        return [
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

    public function handleDataCreate(array $data): array
    {
        $data["created_by"] = auth('admin')->user()->id ?? 1;
        return $data;
    }

    public function handleDataUpdate(array $data): array
    {
        $data["updated_by"] = auth('admin')->user()->id ?? 1;
        return $data;
    }
}
