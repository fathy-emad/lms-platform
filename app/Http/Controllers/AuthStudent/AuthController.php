<?php

namespace App\Http\Controllers\AuthStudent;

use ApiResponse;
use App\Http\Controllers\AuthStudent\Requests\RegisterRequest;
use App\Http\Controllers\AuthStudent\Requests\{
    ChangePasswordRequest,
    LoginRequest,
    NewPasswordRequest,
    ResetPasswordRequest,
    VerifyTokenRequest
};
use App\Http\Controllers\AuthStudent\Resources\LoginResource;
use App\Http\Controllers\AuthStudent\Resources\LogoutResource;
use App\Http\Controllers\Controller;
use App\Http\Repositories\StudentRepository;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(
        protected StudentRepository $repository,
        protected AuthRequestHandler $requestHandler,
        protected $resource = AuthResource::class,
    ){}

    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $this->requestHandler->set($request->validated())->handleRegister()->get();
        return parent::create_model($data);
    }

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
        if ($data["success"]) return ApiResponse::sendSuccess(null, "Verification code sent to {$request->validated('email')} successfully", null);
        else return ApiResponse::sendError(["Some thing went wrong please try again later"], "Reset Password failed", null);
    }

    public function verifyToken(VerifyTokenRequest $request): JsonResponse
    {
        $data = $this->requestHandler->set($request->validated())->handleVerifyToken()->get();
        if ($data["success"]) return ApiResponse::sendSuccess($data["verifyToken"], "Verification code verified successfully", null);
        else return ApiResponse::sendError(["Some thing went wrong please try again later"], "Verification code failed", null);
    }

    public function newPassword(NewPasswordRequest $request): JsonResponse
    {
        $data = $this->requestHandler->set($request->validated())->handleNewPassword()->get();
        if ($data["success"]) return ApiResponse::sendSuccess(new LoginResource($data["data"]), "New password set and logged in successfully", null);
        else return ApiResponse::sendError(["Some thing went wrong please try again later"], "New password failed", null);
    }

}
