<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Models\Admin;
use App\Enums\AdminStatusEnum;
use App\Concretes\RequestHandler;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
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
        $this->terminateJwtTokenFromModel();
        return $this;
    }

    public function attempt(): void
    {
        if (!$token = Auth::guard("admin")->attempt($this->data))
        {
            $this->data["token"] = null;
            $this->data["message"] = "your email or password is invalid";
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
            $this->data["message"] = "you are not active Admin please contact with owner";
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
    public function terminateJwtTokenFromModel(): void
    {
        $model = Admin::find(auth('admin')->user()->id);
        $model->update(["jwtToken" => null, "online" => 0]);
        JWTAuth::invalidate(JWTAuth::getToken());
        auth('admin')->logout();
        $this->data["data"] = $model;
    }

    public function handleChangePassword(): static
    {
        $model = Admin::find(auth('admin')->user()->id);
        $model->update(["password" => Hash::make($this->data["password"])]);
        $this->data["data"] = $model;
        return $this;
    }
    public function handleForgetPassword():static
    {
        $token = generateToken(6);
        $model = Admin::where("email", $this->data["email"])->update(["verifyToken" => $token]);
        //send email here and check if model updated and email sent return true
        $this->data["success"] = (bool) $model;
        return $this;
    }
    public function handleNewPassword():static
    {
        $model = Admin::firstWhere('email', $this->data["email"]);
        $model->update([
            "password" => Hash::make($this->data["password"]),
            "verifyToken" => null
        ]);
        $this->data["success"] = true;
        $this->data["data"] = $model;
        return $this;
    }
}
