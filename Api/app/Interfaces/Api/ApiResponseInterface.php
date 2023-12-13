<?php

namespace App\Interfaces\Api;

use Illuminate\Http\JsonResponse;

interface ApiResponseInterface
{
    public function handle(int $status_code, ?array $messages, ?array $data): array;
    public function send(int $status_code, ?array $messages, ?array $data, ?array $headers): JsonResponse;
}
