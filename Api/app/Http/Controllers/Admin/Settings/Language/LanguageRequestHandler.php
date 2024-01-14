<?php

namespace App\Http\Controllers\Admin\Settings\Language;

use App\Concretes\RequestHandler;
use Translation;
use UploadFile;

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
