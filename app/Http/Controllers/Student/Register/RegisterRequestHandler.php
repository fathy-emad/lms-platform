<?php

namespace App\Http\Controllers\Student\Register;

use UploadFile;
use Illuminate\Support\Arr;
use App\Concretes\RequestHandler;
use Illuminate\Support\Facades\Hash;

class RegisterRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->uploadImage();
        $this->hashPassword();
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->uploadImage($model);
        return $this;
    }

    public function hashPassword(): void
    {
        $this->data["password"] = Hash::make($this->data["password"]);
        $this->data = Arr::except($this->data, 'password_confirmation');
    }

    public function uploadImage($model): void
    {
        if (isset($this->data["image"]))
        {
            $this->data["image"] = UploadFile::uploadFile('public', $this->data["image"], 'student/images', $model, 'image');
        }
    }

}
