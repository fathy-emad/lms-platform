<?php

namespace App\Http\Controllers\Setting\Country;


use App\Concretes\RequestHandler;
use App\Enums\ActiveEnum;
use Translation;
use UploadFile;

class CountryRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->uploadFlag();
        $this->translateCountry(null);
        $this->translateCurrency(null);
        $this->handleActiveEnum();
        $this->bindCreatedBy();
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->uploadFlag($model);
        $this->translateCountry($model->country);
        $this->translateCurrency($model->currency);
        $this->handleActiveEnum();
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

    public function uploadFlag($model = null): void
    {
        $this->data["flag"] = UploadFile::uploadFile('public', $this->data["flag"], 'countries/flags', $model, "flag");
    }

}
