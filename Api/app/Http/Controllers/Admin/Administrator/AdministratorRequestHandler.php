<?php

namespace App\Http\Controllers\Admin\Administrator;

use App\Concretes\RequestHandler;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AdministratorRequestHandler extends RequestHandler
{

    public function handleCreate(): static
    {
        $this->hashPassword();
        $this->bindCreatedBy();
        return $this;
    }

    public function handleUpdate(): static
    {
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
}
