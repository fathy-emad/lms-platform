<?php

namespace App\Http\Controllers\Admin\Country;

use App\Concretes\RequestHandler;
use App\Traits\TranslationTrait;

class CountryRequestHandler extends RequestHandler
{
    use TranslationTrait;

    public function handleCreate(): static
    {
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
}
