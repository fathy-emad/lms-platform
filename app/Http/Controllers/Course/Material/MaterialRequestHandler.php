<?php

namespace App\Http\Controllers\Course\Material;

use UploadFile;
use Translation;
use App\Enums\FreeEnum;
use App\Concretes\RequestHandler;

class MaterialRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->uploadImages();
        $this->uploadFiles();
        $this->handleActiveEnum();
        $this->handleFreeEnum();
        $this->translateDescription(null);
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->uploadImages($model);
        $this->uploadFiles($model);
        $this->handleActiveEnum();
        $this->handleFreeEnum();
        $this->translateDescription($model->description);
        return $this;
    }

    public function uploadImages($model = null): void
    {
        if (isset($this->data["images"]))
        {
            $this->data["images"] = UploadFile::uploadFiles('public', $this->data["images"], 'course/materials/images', $model, 'images');
        }
    }

    public function uploadFiles($model = null): void
    {
        if (isset($this->data["files"]))
        {
            $this->data["files"] = UploadFile::uploadFiles('public', $this->data["files"], 'course/materials/files', $model, 'files');
        }
    }

    public function handleFreeEnum(): void
    {
        $this->data["FreeEnum"] = isset($this->data["FreeEnum"]) ? FreeEnum::Free->value :  FreeEnum::NotFree->value;
    }

    public function translateDescription(?int $id): void
    {
        $this->data["description"] = Translation::translate('description', 'materials', $this->data["description"], $id);
    }
}
