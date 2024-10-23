<?php

namespace App\Http\Controllers\Course\Register;

use UploadFile;
use Translation;
use App\Concretes\RequestHandler;

class CourseRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {

        $this->bindCreatedBy();
        $this->uploadImage();
        $this->translateTitle(null);
        $this->translateDescription(null);
        $this->handleActiveEnum();
        $this->handleFeatured();
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->bindUpdatedBy();
        $this->uploadImage($model);
        $this->translateTitle($model->title);
        $this->translateDescription($model->description);
        $this->handleActiveEnum();
        $this->handleFeatured();
        return $this;
    }


    public function translateTitle(?int $id): void
    {
        $this->data["title"] = Translation::translate('title', 'courses', $this->data["title"], $id);
    }
    public function translateDescription(?int $id): void
    {
        $this->data["description"] = Translation::translate('description', 'courses', $this->data["description"], $id);
    }

    public function uploadImage($model = null): void
    {
        $this->data["image"] = UploadFile::uploadFile('public', $this->data["image"], 'courses/images', $model, "image");
    }

    public function handleFeatured(): void
    {
        $this->data["IsFeatured"] = isset($this->data["IsFeatured"]) && $this->data["IsFeatured"];
    }
}
