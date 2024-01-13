<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Admin\Auth\Resources\LogoutResource;
use App\Http\Controllers\Admin\Auth\Resources\LoginResource;
use App\Http\Controllers\Admin\Auth\Requests\{LoginRequest};
use App\Http\Controllers\Controller;
use App\Http\Repositories\AdministratorRepository;
use Illuminate\Http\JsonResponse;
use ApiResponse;

class AuthController extends Controller
{
    public function __construct(
        protected AdministratorRepository $repository,
        protected AuthRequestHandler $requestHandler
    ){}

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $this->requestHandler->set($request->validated())->handleLogin()->get();
        if (! $data["token"]) return ApiResponse::sendError(["Login error"], $data["message"], null);
        return ApiResponse::sendSuccess(new LoginResource($data["data"]), "Login successfully", null);
    }

    public function logout(): JsonResponse
    {
        $data = $this->requestHandler->set(null)->handleLogout()->get();
        return ApiResponse::sendSuccess(new LogoutResource($data["data"]), "logout successfully", null);
    }
}
