<?php

namespace App\Interfaces;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

interface ApiResponseInterface
{
    public function handle(mixed $data, string $message, ?array $errors, string $method): array;
    public function withPagination(?LengthAwarePaginator $paginationData): static;
    public function sendSuccess(mixed $data, string $message, ?array $headers): JsonResponse;
    public function sendError(array $errors, string $message, ?array $headers): JsonResponse;
}
