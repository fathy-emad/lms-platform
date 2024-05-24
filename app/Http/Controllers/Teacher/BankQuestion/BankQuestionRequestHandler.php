<?php

namespace App\Http\Controllers\Teacher\BankQuestion;

use UploadFile;
use App\Concretes\RequestHandler;

class BankQuestionRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->uploadImages();
        $this->handleActiveEnum();
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->uploadImages($model);
        $this->handleActiveEnum();
        return $this;
    }

    public function uploadImages($model = null): void
    {
        if (isset($this->data["images"]))
        {
            $this->data["images"] = UploadFile::uploadFiles('public', $this->data["images"], 'questions/images', $model, 'images');
        }
    }

}
