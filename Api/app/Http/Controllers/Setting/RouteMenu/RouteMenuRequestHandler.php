<?php

namespace App\Http\Controllers\Setting\RouteMenu;

use App\Concretes\RequestHandler;
use App\Models\RouteMenu;
use Translation;
use UploadFile;

class RouteMenuRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->uploadIcon();
        $this->translateTitle(null);
        $this->setPriority();
        $this->bindCreatedBy();
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->uploadIcon($model);
        $this->translateTitle($model->title);
        $this->bindUpdatedBy();
        return $this;
    }

    public function translateTitle(?int $id): void
    {
        $this->data["title"] = Translation::translate('title', 'route_menus', $this->data["title"], $id);
    }

    public function uploadIcon($model = null): void
    {
        $this->data["icon"] = UploadFile::uploadFile('public', $this->data["icon"], 'route/menu/icon', $model, 'icon');
    }

    public function setPriority(): void
    {

        $model = RouteMenu::orderBy('priority', 'desc')->first();

        if ($model){
            $this->data["priority"] = $model->priority + 1;
        }

        else
        {
            $this->data["priority"] = 1;
        }
    }
}
