<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Concretes\RequestHandler;
use App\Enums\AdminStatusEnum;
use App\Models\Admin;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AuthRequestHandler extends RequestHandler
{
    public function handleLogin(): static
    {
        $this->attempt();
        $this->checkStatus();
        $this->addJwtTokenToModel();
        return $this;
    }

    public function handleLogout(): static
    {
        $model = Admin::find(auth('admin')->user()->id);
        $model->update(["jwtToken" => null]);
        $this->data["data"] = $model;
        return $this;
    }

    public function handleChangePassword(): static
    {
        $model = Admin::find(auth('admin')->user()->id);
        $model->update(["password" => Hash::make($this->data["password"])]);
        $this->data["data"] = $model;
        return $this;
    }

    public function handleResetPassword():static
    {
        $token = generateToken(6);
        $model = Admin::where("email", $this->data["email"])->update(["verifyToken" => $token]);
        //send email here and check if model updated and email sent return true
        $this->data["success"] = (bool) $model;
        return $this;
    }

    public function attempt(): void
    {
        if (! $token = auth('admin')->attempt($this->data))
        {
            $this->data["token"] = null;
            $this->data["message"] = "you are not Auth Admin";
        }

        else
        {
            $this->data["message"] = "you are Auth";
            $this->data["token"] = $token;
        }
    }

    public function checkStatus(): void
    {
        if (isset($this->data["token"]) && auth('admin')->user()->AdminStatusEnum->value != AdminStatusEnum::Active->value)
        {
            $this->data["token"] = null;
            $this->data["message"] = "you are not Active Admin";
        }
    }

    public function addJwtTokenToModel(): void
    {
        if ($this->data["token"])
        {
            $model = Admin::find(auth('admin')->user()->id);
            $model->update(["jwtToken" => $this->data["token"]]);
            $this->data["data"] = $model;
        }
    }

}
