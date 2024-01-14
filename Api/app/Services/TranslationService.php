<?php

namespace App\Services;

use App\Models\Language;
use App\Models\Translate;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationService
{
    public function translate(string $filed, string $table, array|string $data, ?int $id): int
    {
        if (
            ! in_array("ar", array_column((Language::all())->toArray(), "locale")) ||
            ! in_array("en", array_column((Language::all())->toArray(), "locale"))
        ) $languages = ["ar", "en"];
        else $languages = array_column((Language::all())->toArray(), "locale");

        $languages = $this->getLanguages($languages);
        $googleTranslate = new GoogleTranslate();
        $data = $this->handleTranslate($data, $languages, $googleTranslate);
        $data = array_merge(
            ["translates" => $data],
            ["key" => $data["en"], "field" => $filed, "table" => $table]
        );

        if(! isset($id)) return $this->createTranslate($data);
        else return $this->updateTranslate($data, $id);
    }

    public function handleTranslate(array|string $data, array $languages, GoogleTranslate $googleTranslate): array
    {
        $translates = [];

        //on create translates
        if (! is_array($data))
        {
            foreach ($languages AS $lang) $translates[$lang] = $googleTranslate->setSource()->setTarget($lang)->translate($data);
        }

        //on update translates
        else
        {
            foreach ($languages AS $lang)
            {
                if (! isset($data[$lang]) || ! $data[$lang]) $translates[$lang] = $googleTranslate->setSource("ar")->setTarget($lang)->translate($data["ar"]);
                else $translates[$lang] = $data[$lang];
            }
        }

        return $translates;
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

    /**
     * if translation service called from languages controller
     * get new locale  from request to add it to current languages and translate it
     *
     * @param array $languages
     * @return array
     *
     */
    public function getLanguages(array $languages): array
    {
        if (
            class_basename(static::class) == "LanguageRequestHandler"
            && ! in_array($this->data["locale"], $languages)
        ) $languages[] = $this->data["locale"];

        return $languages;
    }
}
