<?php

namespace App\Http\Controllers\Employee\Register;

use App\Concretes\RequestHandler;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use UploadFile;

class RegisterRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->uploadImage();
        $this->hashPassword();
        $this->bindCreatedBy();
        return $this;
    }

    public function handleUpdate(): static
    {
        $this->uploadImage();
        $this->hashPasswordIfExists();
        $this->bindUpdatedBy();
        return $this;
    }

    public function hashPassword(): void
    {
        $this->data["password"] = Hash::make($this->data["password"]);
        $this->data = Arr::except($this->data, 'password_confirmation');
    }

    public function hashPasswordIfExists(): void
    {
        if (isset($this->data["password"]))
        {
            $this->hashPassword();
        }

        else
        {
            $this->data = Arr::except($this->data, 'password');
            $this->data = Arr::except($this->data, 'password_confirmation');
        }
    }

    public function uploadImage(): void
    {
        if (isset($this->data["image"]))
        {
            $this->data["image"] = UploadFile::upload('public', $this->data["image"], 'admins/images');
        }
    }
}
