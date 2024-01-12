<?php

namespace App\Http\Controllers\Admin\Settings\Enumeration;

use App\Concretes\RequestHandler;
use App\Models\Enumeration;
use App\Traits\TranslationTrait;
use App\Traits\UploadFileTrait;

class EnumerationRequestHandler extends RequestHandler
{
    use TranslationTrait, UploadFileTrait;

    public function handleCreate(): static
    {
        $this->translateValue(null);
        $this->setPriority();
        $this->bindCreatedBy();
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->translateValue($model->value);
        $this->bindUpdatedBy();
        return $this;
    }

    public function translateValue(?int $id): void
    {
        $this->data["value"] = $this->translate('value', 'enumerations', $this->data["value"], $id);
    }

    public function setPriority(): void
    {
        $enumerationModel = Enumeration::where('key', $this->data["key"])->orderBy('priority', 'desc')->first();

        if ($enumerationModel){
            $this->data["priority"] = $enumerationModel->priority + 1;
        }

        else
        {
            $this->data["priority"] = 1;
        }
    }
}
