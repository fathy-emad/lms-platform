<?php

namespace App\Http\Controllers\AuthAdmin;

use ApiResponse;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Repositories\AdminRepository;
use App\Http\Controllers\AuthAdmin\Resources\LoginResource;
use App\Http\Controllers\AuthAdmin\Resources\LogoutResource;
use App\Http\Controllers\AuthAdmin\Requests\{ChangePasswordRequest,
    ForgetPasswordRequest,
    LoginRequest,
    NewPasswordRequest,
};

class AuthController extends Controller
{
    public function __construct(
        protected AdminRepository $repository,
        protected AuthRequestHandler $requestHandler
    ){}

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $this->requestHandler->set($request->validated())->handleLogin()->get();
        if (! $data["token"]) return ApiResponse::sendError(["Authentication error" => [$data["message"]]], "Login Failed", null);
        return ApiResponse::sendSuccess(new LoginResource($data["data"]), "Login successfully", null);
    }

    public function logout(): JsonResponse
    {
        $data = $this->requestHandler->set(null)->handleLogout()->get();
        return ApiResponse::sendSuccess(new LogoutResource($data["data"]), "logout successfully", null);
    }

    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $data = $this->requestHandler->set($request->validated())->handleChangePassword()->get();
        return ApiResponse::sendSuccess(null, "Password changed successfully", null);
    }

    public function forgetPassword(ForgetPasswordRequest $request): JsonResponse
    {
        $data = $this->requestHandler->set($request->validated())->handleForgetPassword()->get();
        if ($data["success"]) return ApiResponse::sendSuccess(null, "Verification code sent to {$request->validated('email')} successfully", null);
        else return ApiResponse::sendError(["Reset Password error" => ["Some thing went wrong please try again later"]], "Reset Password failed", null);
    }
    public function newPassword(NewPasswordRequest $request): JsonResponse
    {
        $data = $this->requestHandler->set($request->validated())->handleNewPassword()->get();
        if ($data["success"]) return ApiResponse::sendSuccess(null, "New password set successfully", null);
        else return ApiResponse::sendError(["new password error" => ["Some thing went wrong please try again later"]], "New password failed", null);
    }

}
