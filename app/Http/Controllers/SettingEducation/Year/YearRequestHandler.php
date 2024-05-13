<?php

namespace App\Http\Controllers\SettingEducation\Year;

use Translation;
use App\Concretes\RequestHandler;

class YearRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->bindCreatedBy();
        $this->handleActiveEnum();
        $this->translateYear(null);
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->bindUpdatedBy();
        $this->handleActiveEnum();
        $this->translateYear($model->year);
        return $this;
    }

    public function translateYear(?int $id): void
    {
        $this->data["year"] = Translation::translate('year', 'years', $this->data["year"], $id);
    }
}
