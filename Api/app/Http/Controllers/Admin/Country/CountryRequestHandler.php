<?php

namespace App\Http\Controllers\Admin\Country;

use App\Concretes\RequestHandler;
use App\Traits\TranslationTrait;
use App\Traits\UploadFileTrait;

class CountryRequestHandler extends RequestHandler
{
    use TranslationTrait, UploadFileTrait;

    public function handleCreate(): static
    {
        $this->uploadFlag();
        $this->translateCountry(null);
        $this->translateCurrency(null);
        $this->bindCreatedBy();
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->translateCountry($model->country);
        $this->translateCurrency($model->currency);
        $this->bindUpdatedBy();
        return $this;
    }

    public function translateCountry(?int $id): void
    {
        $this->data["country"] = $this->translate($this->data["country"], $id);
    }
    public function translateCurrency(?int $id): void
    {
        $this->data["currency"] = $this->translate($this->data["currency"], $id);
    }

    public function uploadFlag(): void
    {
        if (isset($this->data["flag"]))
        {
            $this->data["flag"] = $this->upload('public', $this->data["flag"], 'countries/flags', []);
        }
    }
}
