<?php

namespace App\Http\Controllers\Admin\Teacher\Register;

use UploadFile;
use App\Concretes\RequestHandler;
use Illuminate\Support\Arr;
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

    public function handleUpdate(): static
    {
        $this->uploadImage();
        $this->uploadContract();
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
            $this->data["image"] = UploadFile::upload('public', $this->data["image"], 'teachers/images');
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
