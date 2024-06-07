<?php

namespace App\Http\Controllers\AuthTeacher;

use ApiResponse;
use App\Http\Repositories\TeacherRepository;
use App\Http\Controllers\AuthTeacher\Requests\LoginRequest;
use App\Http\Controllers\AuthTeacher\Resources\LoginResource;
use App\Http\Controllers\AuthTeacher\Resources\LogoutResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(
        protected TeacherRepository $repository,
        protected AuthRequestHandler $requestHandler
    ){}

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $this->requestHandler->set($request->validated())->handleLogin()->get();
        if (! $data["token"]) return ApiResponse::sendError([$data["message"]], "Login error", null);
        return ApiResponse::sendSuccess(new LoginResource($data["data"]), "Login successfully", null);
    }

    public function logout(): JsonResponse
    {
        $data = $this->requestHandler->set(null)->handleLogout()->get();
        return ApiResponse::sendSuccess(new LogoutResource($data["data"]), "logout successfully", null);
    }
}
