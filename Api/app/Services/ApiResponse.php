<?php

namespace App\Services;

use App\Http\Resources\PaginationResource;
use App\Interfaces\ApiResponseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiResponse implements ApiResponseInterface
{
    protected ?LengthAwarePaginator $paginationData;
    public function handle(mixed $data, string $message, ?array $errors, string $method): array
    {
        $method = explode("::", $method)[1];
        $response["statusCode"] = $method == "sendSuccess" ? 200 : 422;
        $response["success"] = $method == "sendSuccess";
        $response["message"] = $message;

        if ($method == "sendSuccess") $response["data"] = $data;
        else $response["errors"] = $errors;

        if (isset($this->paginationData)) $response["paginationData"] = new PaginationResource($this->paginationData);

        return $response;
    }

    public function withPagination(LengthAwarePaginator $paginationData = null): static
    {
        $this->paginationData = $paginationData;
        return $this;
    }

    public function sendSuccess(mixed $data, string $message, ?array $headers): JsonResponse
    {
        $response = $this->handle($data, $message, null, __METHOD__);
        return response()->json($response)->withHeaders($headers ?? []);
    }

    public function sendError(array $errors, string $message, ?array $headers): JsonResponse
    {
        $response = $this->handle(null, $message, $errors, __METHOD__);
        return response()->json($response)->withHeaders($headers ?? []);
    }
}
