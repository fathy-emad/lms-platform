<?php

namespace App\Http\Controllers\AuthTeacher;

use Notification;
use App\Models\Teacher;
use App\Enums\TeacherStatusEnum;
use App\Concretes\RequestHandler;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Concretes\NotificationEmail;

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
        if (!$token = Auth::guard("teacher")->attempt($this->data))
        {
            $this->data["token"] = null;
            $this->data["message"] = "Your email or password is invalid";
        }

        else
        {
            $this->data["message"] = "you are Auth";
            $this->data["token"] = $token;
        }
    }
    public function checkStatus(): void
    {
        if (isset($this->data["token"]) && auth('teacher')->user()->TeacherStatusEnum->value != TeacherStatusEnum::Active->value)
        {
            $this->data["token"] = null;
            $this->data["message"] = "You are not active teacher account please contact with website";
        }
    }
    public function addJwtTokenToModel():void
    {
        if ($this->data["token"])
        {
            $model = Teacher::find(auth('teacher')->user()->id);
            $model->update(["jwtToken" => $this->data["token"]]);
            $this->data["data"] = $model;
        }
    }
    public function terminateJwtTokenFromModel(): void
    {
        $model = Teacher::find(auth('teacher')->user()->id);
        $model->update(["jwtToken" => null, "online" => 0]);
        JWTAuth::invalidate(JWTAuth::getToken());
        auth('teacher')->logout();
        $this->data["data"] = $model;
    }
    public function handleForgetPassword():static
    {
        $token = generateToken(6);
        $model = Teacher::where("email", $this->data["email"]);
        $teacher = $model->first();
        $update = $model->update(["verifyToken" => $token]);
        Notification::via([new NotificationEmail()])->send($teacher->fresh(), null, "otp");
        $this->data["success"] = (bool) $update;
        return $this;
    }
    public function handleNewPassword():static
    {
        $model = Teacher::firstWhere('email', $this->data["email"]);
        $model->update([
            "password" => Hash::make($this->data["password"]),
            "verifyToken" => null
        ]);
        $this->data["success"] = true;
        $this->data["data"] = $model;
        return $this;
    }

    public function handleChangePassword(): static
    {
        $model = Teacher::find(auth('teacher')->id());
        $model->update(["password" => Hash::make($this->data["password"])]);
        $this->data["data"] = $model;
        return $this;
    }

}
