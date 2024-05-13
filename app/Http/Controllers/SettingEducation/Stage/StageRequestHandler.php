<?php

namespace App\Http\Controllers\SettingEducation\Stage;

use Translation;
use App\Concretes\RequestHandler;

class StageRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->bindCreatedBy();
        $this->handleActiveEnum();
        $this->translateStage(null);
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->bindUpdatedBy();
        $this->handleActiveEnum();
        $this->translateStage($model->stage);
        return $this;
    }


    public function translateStage(?int $id): void
    {
        $this->data["stage"] = Translation::translate('stage', 'stages', $this->data["stage"], $id);
    }
}
