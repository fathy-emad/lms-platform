<?php

namespace App\Http\Controllers\SettingEducation\Stage;

use App\Models\Stage;
use Illuminate\Http\JsonResponse;
use Translation;
use App\Concretes\RequestHandler;

class StageRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->setPriority();
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


    public function setPriority(): void
    {
        $model = Stage::orderBy('priority', 'desc')->first();
        $this->data["priority"] = ($model->priority ?? 0) + 1;
    }

    public function handleReorder($model): JsonResponse
    {
        return $this->reorder($model);
    }

    public function translateStage(?int $id): void
    {
        $this->data["stage"] = Translation::translate('stage', 'stages', $this->data["stage"], $id);
    }

}
