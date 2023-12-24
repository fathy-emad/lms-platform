<?php

namespace App\Http\Controllers\Admin\Language;

use App\Concretes\RequestHandler;
use App\Traits\TranslationTrait;

class LanguageRequestHandler extends RequestHandler
{
    use TranslationTrait;

    public function handleCreate(): static
    {
        $this->translateLanguage(null);
        $this->bindCreatedBy();
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->translateLanguage($model->language);
        $this->bindUpdatedBy();
        return $this;
    }

    public function translateLanguage(?int $id): void
    {
        $this->data["language"] = $this->translate($this->data["language"], $id);
    }
}
