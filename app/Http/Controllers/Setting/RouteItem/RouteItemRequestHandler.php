<?php

namespace App\Http\Controllers\Setting\RouteItem;

use UploadFile;
use Translation;
use App\Models\RouteItem;
use App\Concretes\RequestHandler;

class RouteItemRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->uploadIcon();
        $this->translateTitle(null);
        $this->handleActiveEnum();
        $this->setPriority();
        $this->bindCreatedBy();
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->uploadIcon($model);
        $this->translateTitle($model->title);
        $this->handleActiveEnum();
        $this->bindUpdatedBy();
        return $this;
    }

    public function translateTitle(?int $id): void
    {
        $this->data["title"] = Translation::translate('title', 'route_items', $this->data["title"], $id);
    }

    public function uploadIcon($model = null): void
    {
        $this->data["icon"] = UploadFile::uploadFile('public', $this->data["icon"] ?? null, 'route/item/icon', $model, 'icon');
    }

    public function setPriority(): void
    {

        $model = RouteItem::orderBy('priority', 'desc')->first();

        if ($model){
            $this->data["priority"] = $model->priority + 1;
        }

        else
        {
            $this->data["priority"] = 1;
        }
    }
}
