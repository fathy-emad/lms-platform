<?php

namespace App\Http\Controllers\AuthAdmin;

use ApiResponse;
use App\Http\Controllers\AuthAdmin\Requests\{ChangePasswordRequest,
    LoginRequest,
    ResetPasswordRequest,
    VerifyTokenRequest};
use App\Http\Controllers\AuthAdmin\Resources\LoginResource;
use App\Http\Controllers\AuthAdmin\Resources\LogoutResource;
use App\Http\Controllers\Controller;
use App\Http\Repositories\AdminRepository;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(
        protected AdminRepository $repository,
        protected AuthRequestHandler $requestHandler
    ){}

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $this->requestHandler->set($request->validated())->handleLogin()->get();
        if (! $data["token"]) return ApiResponse::sendError([$data["message"]], "Login Failed", null);
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

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $data = $this->requestHandler->set($request->validated())->handleResetPassword()->get();
        if ($data["success"]) return ApiResponse::sendSuccess(null, "Verify token sent to {$request->validated('email')} successfully", null);
        else return ApiResponse::sendError(["Some thing went wrong please try again after 5 min"], "Reset Password failed", null);
    }

    public function verifyToken(VerifyTokenRequest $request): JsonResponse
    {

    }

}
