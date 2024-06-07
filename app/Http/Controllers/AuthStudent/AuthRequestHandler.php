<?php

namespace App\Http\Controllers\AuthStudent;

use UploadFile;
use App\Models\Admin;
use App\Models\Student;
use Illuminate\Support\Arr;
use App\Concretes\RequestHandler;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $this->addJwtTokenToModel();
        return $this;
    }
    public function handleLogout(): static
    {
        $this->terminateJwtTokenFromModel();
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
        $model = Student::where("phone", $this->data["phone"])->update(["verifyToken" => $hashToken]);
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
        Auth::login($model);
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
    public function addJwtTokenToModel(): void
    {
        if ($this->data["token"])
        {
            $model = Student::find(auth('student')->user()->id);
            $model->update(["jwtToken" => $this->data["token"], "online" => 1]);
            $this->data["data"] = $model;
        }
    }
    public function hashPassword(): void
    {
        $this->data["password"] = Hash::make($this->data["password"]);
        $this->data = Arr::except($this->data, 'password_confirmation');
    }
    public function uploadImage(): void
    {
        if (isset($this->data["image"]))
        {
            $this->data["image"] = UploadFile::uploadFile('public', $this->data["image"], 'student/images', null, 'image');
        }
    }






    public function attempt(): void
    {
        if (!$token = Auth::guard('student')->attempt($this->data))
        {
            $this->data["token"] = null;
            $this->data["message"] = "you are not Auth Student";
        }

        else
        {
            $this->data["message"] = "you are Auth";
            $this->data["token"] = $token;
        }
    }
    public function terminateJwtTokenFromModel(): void
    {
        $model = Student::find(auth('student')->user()->id);
        $model->update(["jwtToken" => null, "online" => 0]);
        JWTAuth::invalidate(JWTAuth::getToken());
        auth('student')->logout();
        $this->data["data"] = $model;
    }
}
