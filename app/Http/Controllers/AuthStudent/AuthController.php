<?php

namespace App\Http\Controllers\AuthStudent;

use ApiResponse;
use App\Http\Controllers\AuthStudent\Requests\RegisterRequest;
use App\Http\Controllers\AuthStudent\Requests\{
    ChangePasswordRequest,
    ForgetPasswordRequest,
    NewPasswordRequest,
    LoginRequest,
 };
use App\Http\Controllers\AuthStudent\Resources\LoginResource;
use App\Http\Controllers\AuthStudent\Resources\LogoutResource;
use App\Http\Controllers\Controller;
use App\Http\Repositories\StudentRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class AuthController extends Controller
{
    public function __construct(
        protected StudentRepository $repository,
        protected AuthRequestHandler $requestHandler,
        protected string $resource = AuthResource::class,
    ){}

    public function register(RegisterRequest $request): JsonResponse
    {
        $data = Arr::except($this->requestHandler->set($request->validated())->handleRegister()->get(), ["terms_of_service_and_privacy_policy"]);
        return parent::create_model($data);
    }
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $this->requestHandler->set($request->validated())->handleLogin()->get();
        if (! $data["token"]) return ApiResponse::sendError(["Authentication error" => [$data["message"]]], __("lang.login_error"), null);
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
        else return ApiResponse::sendError(["Reset password error" => ["Some thing went wrong please try again later"]], "Reset Password failed", null);
    }
    public function newPassword(NewPasswordRequest $request): JsonResponse
    {
        $data = $this->requestHandler->set($request->validated())->handleNewPassword()->get();
        if ($data["success"]) return ApiResponse::sendSuccess(null, "New password set successfully", null);
        else return ApiResponse::sendError(["new password error" => ["Some thing went wrong please try again later"]], "New password failed", null);
    }

}
