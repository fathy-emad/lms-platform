<?php

namespace App\Services;

use App\Concretes\RequestHandler;
use App\Models\Language;
use App\Models\Translate;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationService
{

    protected $googleTranslate;
    public function __construct()
    {
        $this->googleTranslate = new GoogleTranslate();
    }

    public function translate(string $filed, string $table, array|string $data, ?int $id): int
    {
        $languages = $this->getLanguages();
        $data = $this->handleTranslate($data, $languages);
        $data = array_merge(["translates" => $data], ["key" => $data["en"], "field" => $filed, "table" => $table]);

        if(! isset($id)) return $this->createTranslate($data);
        else return $this->updateTranslate($data, $id);
    }

    public function handleTranslate(array|string $data, array $languages): array
    {
        $translates = [];

        //on create translates
        if (! is_array($data))
        {
            foreach ($languages AS $lang) $translates[$lang] = $this->googleTranslate->setSource()->setTarget($lang)->translate($data);
        }

        //on update translates
        else
        {
            foreach ($languages AS $lang)
            {
                if (! isset($data[$lang])) $translates[$lang] = $this->googleTranslate->setSource("ar")->setTarget($lang)->translate($data["ar"]);
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
     * and check languages of system to get correct languages to translate
     *
     * @return array
     */
    public function getLanguages(): array
    {
        if (
            ! in_array("ar", array_column((Language::all())->toArray(), "locale")) ||
            ! in_array("en", array_column((Language::all())->toArray(), "locale"))
        ) $languages = ["ar", "en"];
        else $languages = array_column((Language::all())->toArray(), "locale");

        $backtrace = debug_backtrace();
        $handlerClass = "";
        foreach ($backtrace as $trace) {
            if (isset($trace['class']) && is_subclass_of($trace['class'], RequestHandler::class)) {
                $handlerClass = $trace['class'];
                break;
            }
        }

        if (class_basename($handlerClass) == "LanguageRequestHandler" && ! in_array(request()->get("locale"), $languages))
            $languages[] = request()->get("locale");

        return $languages;
    }
}
