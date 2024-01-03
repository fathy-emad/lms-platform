<?php

namespace App\Http\Controllers\Admin\Settings\Language;

use App\Concretes\RequestHandler;
use App\Traits\TranslationTrait;
use App\Traits\UploadFileTrait;

class LanguageRequestHandler extends RequestHandler
{
    use TranslationTrait, UploadFileTrait;

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
        $this->data["language"] = $this->translate('language', 'languages', $this->data["language"], $id);
    }

    public function uploadFlag(): void
    {
        if (isset($this->data["flag"]))
        {
            $this->data["flag"] = $this->upload('public', $this->data["flag"], 'languages/flags');
        }
    }
}
