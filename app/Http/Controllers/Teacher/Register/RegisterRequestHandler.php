<?php

namespace App\Http\Controllers\Teacher\Register;

use UploadFile;
use Illuminate\Support\Arr;
use App\Concretes\RequestHandler;
use Illuminate\Support\Facades\Hash;

class RegisterRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->uploadImage();
        $this->uploadContract();
        $this->hashPassword();
        $this->bindCreatedBy();
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->uploadImage($model);
        $this->uploadContract();
        $this->bindUpdatedBy();
        return $this;
    }

    public function hashPassword(): void
    {
        $this->data["password"] = Hash::make($this->data["password"]);
        $this->data = Arr::except($this->data, 'password_confirmation');
    }

    public function uploadImage($model = null): void
    {
        if (isset($this->data["image"]))
        {
            $this->data["image"] = UploadFile::uploadFile('public', $this->data["image"], 'teachers/images', $model, 'image');
        }
    }

    public function uploadContract(): void
    {
        if (isset($this->data["contract"]))
        {
            $this->data["contract"] = UploadFile::upload('public', $this->data["contract"], 'teachers/contracts');
        }
    }
}
