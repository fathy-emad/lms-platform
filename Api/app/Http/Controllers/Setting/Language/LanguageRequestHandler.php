<?php

namespace App\Http\Controllers\Setting\Language;

use UploadFile;
use Translation;
use App\Concretes\RequestHandler;

class LanguageRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->translateLanguage(null);
        $this->uploadFlag();
        $this->bindCreatedBy();
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->translateLanguage($model->language);
        $this->uploadFlag();
        $this->bindUpdatedBy();
        return $this;
    }

    public function translateLanguage(?int $id): void
    {
        $this->data["language"] = Translation::translate('language', 'languages', $this->data["language"], $id);
    }

    public function uploadFlag(): void
    {
        if (isset($this->data["flag"]))
        {
            $this->data["flag"] = UploadFile::upload('public', $this->data["flag"], 'languages/flags');
        }
    }
}
