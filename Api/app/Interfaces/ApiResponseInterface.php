<?php

namespace App\Interfaces;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

interface ApiResponseInterface
{
    public function handle(?JsonResource $data, string $message, ?array $errors, string $method): array;

    public function sendSuccess(JsonResource $data, string $message, ?array $headers): JsonResponse;

    public function sendError(array $errors, string $message, ?array $headers): JsonResponse;
}
