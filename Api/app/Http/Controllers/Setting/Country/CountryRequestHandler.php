<?php

namespace App\Http\Controllers\Setting\Country;


use App\Concretes\RequestHandler;
use Translation;
use UploadFile;

class CountryRequestHandler extends RequestHandler
{
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
        $this->data["country"] = Translation::translate('country', 'countries', $this->data["country"], $id);
    }
    public function translateCurrency(?int $id): void
    {
        $this->data["currency"] = Translation::translate('currency', 'countries', $this->data["currency"], $id);
    }

    public function uploadFlag(): void
    {
        if (isset($this->data["flag"]))
        {
            $this->data["flag"] = UploadFile::upload('public', $this->data["flag"], 'countries/flags');
        }
    }
}
