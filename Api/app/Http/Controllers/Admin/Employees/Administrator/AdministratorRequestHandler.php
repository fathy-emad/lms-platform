<?php

namespace App\Http\Controllers\Admin\Employees\Administrator;

use App\Concretes\RequestHandler;
use App\Traits\UploadFileTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AdministratorRequestHandler extends RequestHandler
{
    use UploadFileTrait;
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
            $this->data["image"] = $this->upload('public', $this->data["image"], 'admins/images');
        }
    }
}
