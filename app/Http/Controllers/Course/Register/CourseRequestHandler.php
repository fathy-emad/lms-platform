<?php

namespace App\Http\Controllers\Course\Register;

use Translation;
use App\Concretes\RequestHandler;

class CourseRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->bindCreatedBy();
        $this->translateTitle(null);
        $this->translateDescription(null);
        $this->handleActiveEnum();
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->bindUpdatedBy();
        $this->translateTitle($model->title);
        $this->translateDescription($model->description);
        $this->handleActiveEnum();
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
}
