<?php

namespace App\Http\Controllers\AuthTeacher;

use App\Concretes\RequestHandler;
use App\Enums\TeacherStatusEnum;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;


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
            $this->data["message"] = "you are not Auth Teacher";
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
            $this->data["message"] = "you are not Active Teacher";
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
        $model->update(["jwtToken" => null]);
        $this->data["data"] = $model;
    }
}
