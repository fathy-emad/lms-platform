<?php

namespace App\Http\Controllers\SettingEducation\Stage;

use Translation;
use App\Concretes\RequestHandler;

class StageRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->translateLanguage(null);
        $this->bindCreatedBy();
        $this->handleActiveEnum();
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->bindUpdatedBy();
        $this->handleActiveEnum();
        $this->translateLanguage($model->stage);
        return $this;
    }


    public function translateLanguage(?int $id): void
    {
        $this->data["stage"] = Translation::translate('stage', 'stages', $this->data["stage"], $id);
    }

}
