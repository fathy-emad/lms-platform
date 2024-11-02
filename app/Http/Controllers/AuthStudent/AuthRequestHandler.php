<?php

namespace App\Http\Controllers\AuthStudent;

use UploadFile;
use Notification;
use App\Models\Student;
use Illuminate\Support\Arr;
use App\Enums\StudentStatusEnum;
use App\Concretes\RequestHandler;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Concretes\NotificationEmail;

class AuthRequestHandler extends RequestHandler
{
    public function handleRegister(): static
    {
        $this->uploadImage();
        $this->hashPassword();
        return $this;
    }
    public function handleLogin(): static
    {
        $this->attempt();
        $this->checkStatus();
        $this->addJwtTokenToModel();
        return $this;
    }
    public function handleLogout(): static
    {
        $model = Student::find(auth('student')->user()->id);
        $model->update(["jwtToken" => null, "online" => 0]);
        JWTAuth::invalidate(JWTAuth::getToken());
        auth('student')->logout();
        $this->data["data"] = $model;
        return $this;
    }
    public function handleForgetPassword():static
    {
        $token = generateToken(6);
        $model = Student::where("email", $this->data["email"]);
        $student = $model->first();
        $update = $model->update(["verifyToken" => $token]);
        Notification::via([new NotificationEmail()])->send($student->fresh(), null, "otp");
        $this->data["success"] = (bool) $update;
        return $this;
    }



    public function attempt(): void
    {
        if (!$token = Auth::guard("student")->attempt($this->data))
        {
            $this->data["token"] = null;
            $this->data["message"] = __("lang.invalid_email_password");
        }

        else
        {
            $this->data["message"] = __("lang.you_auth");
            $this->data["token"] = $token;
        }
    }
    public function checkStatus(): void
    {
        if (isset($this->data["token"]) && auth('student')->user()->StudentStatusEnum->value != StudentStatusEnum::Active->value)
        {
            $this->data["token"] = null;
            $this->data["message"] = __("lang.blocked_student");
        }
    }
    public function addJwtTokenToModel(): void
    {
        if ($this->data["token"])
        {
            $model = Student::find(auth('student')->user()->id);
            $model->update(["jwtToken" => $this->data["token"], "online" => 1]);
            $this->data["data"] = $model;
        }
    }

    public function uploadImage(): void
    {
        if (isset($this->data["image"]))
        {
            $this->data["image"] = UploadFile::uploadFile('public', $this->data["image"], 'student/images', null, 'image');
        }
    }

    public function hashPassword(): void
    {
        $this->data["password"] = Hash::make($this->data["password"]);
        $this->data = Arr::except($this->data, 'password_confirmation');
    }

    public function handleNewPassword():static
    {
        $model = Student::firstWhere('email', $this->data["email"]);
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
        $model = Student::find(auth('student')->id());
        $model->update(["password" => Hash::make($this->data["password"])]);
        $this->data["data"] = $model;
        return $this;
    }

}
