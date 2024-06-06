<?php

namespace App\Http\Controllers\Setting\RouteMenu;

use UploadFile;
use Translation;
use App\Models\RouteMenu;
use App\Concretes\RequestHandler;
use Illuminate\Http\JsonResponse;

class RouteMenuRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->uploadIcon();
        $this->translateTitle(null);
        $this->handleActiveEnum();
        $this->setPriority();
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->uploadIcon($model);
        $this->translateTitle($model->title);
        $this->handleActiveEnum();
        return $this;
    }

    public function handleReorder($model): JsonResponse
    {
        return $this->reorder($model);
    }

    public function translateTitle(?int $id): void
    {
        $this->data["title"] = Translation::translate('title', 'route_menus', $this->data["title"], $id);
    }

    public function uploadIcon($model = null): void
    {
        $this->data["icon"] = UploadFile::uploadFile('public', $this->data["icon"] ?? null, 'route/menu/icon', $model, 'icon');
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
