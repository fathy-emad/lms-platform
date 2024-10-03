<?php

namespace App\Http\Controllers\SettingEducation\Year;

use UploadFile;
use Translation;
use App\Models\Year;
use Illuminate\Http\JsonResponse;
use App\Concretes\RequestHandler;

class YearRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {

        $this->setPriority();
        $this->bindCreatedBy();
        $this->handleActiveEnum();
        $this->uploadImage();
        $this->translateYear(null);
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->bindUpdatedBy();
        $this->handleActiveEnum();
        $this->uploadImage($model);
        $this->translateYear($model->year);
        return $this;
    }

    public function translateYear(?int $id): void
    {
        $this->data["year"] = Translation::translate('year', 'years', $this->data["year"], $id);
    }

    public function setPriority(): void
    {
        $model = Year::where("stage_id", $this->data["stage_id"])->orderBy('priority', 'desc')->first();
        $this->data["priority"] = ($model->priority ?? 0) + 1;
    }

    public function handleReorder($model): JsonResponse
    {
        return $this->reorder($model);
    }

    public function uploadImage($model = null): void
    {
        $this->data["image"] = UploadFile::uploadFile('public', $this->data["image"], 'years/images', $model, "image");
    }
}
