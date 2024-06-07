<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Models\Admin;
use App\Concretes\RequestHandler;
use App\Enums\AdminStatusEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

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
        $token = JWTAuth::getToken();
        JWTAuth::invalidate($token);
        $model = Admin::find(auth('admin')->user()->id);
        $model->update(["jwtToken" => null]);
        $this->data["data"] = $model;
        auth('admin')->logout();
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
    public function handleVerifyToken():static
    {
        $hashToken = Hash::make($this->data["verifyToken"]);
        $model = Admin::where("email", $this->data["email"])->update(["verifyToken" => $hashToken]);
        if ($model){
            $this->data["success"] = true;
            $this->data["verifyToken"] = $hashToken;
        } else {
            $this->data["success"] = false;
            $this->data["verifyToken"] = null;
        }
        return $this;
    }
    public function handleNewPassword():static
    {
        $model = Admin::firstWhere('email', $this->data["email"]);
        Auth::guard("admin")->login($model);
        $token = JWTAuth::fromUser($model);
        $model->update([
            "password" => Hash::make($this->data["password"]),
            "jwtToken" => $token,
            "verifyToken" => null
        ]);
        $this->data["success"] = true;
        $this->data["data"] = $model;
        return $this;
    }
    public function attempt(): void
    {
        if (!JWTAuth::attempt($this->data))
        {
            $this->data["token"] = null;
            $this->data["message"] = "you are not Auth Admin";
        }

        else
        {
            $this->data["message"] = "you are Auth";
            $this->data["token"] = JWTAuth::claims(['guard' => 'admin'])->fromUser(auth("admin")->user());
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
