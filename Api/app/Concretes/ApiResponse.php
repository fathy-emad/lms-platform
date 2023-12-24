<?php

namespace App\Concretes;


use App\Interfaces\ApiResponseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiResponse implements ApiResponseInterface
{
    public function handle(?JsonResource $data, string $message, ?array $errors, string $method): array
    {
        $method = explode("::", $method)[1];
        $response["status_code"] = $method == "sendSuccess" ? 200 : 422;
        $response["success"] = $method == "sendSuccess";
        $response["message"] = $message;
        if ($method == "sendSuccess") $response["data"] = $data;
        else $response["errors"] = $errors;
        return $response;
    }

    public function sendSuccess(JsonResource $data, string $message, ?array $headers): JsonResponse
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
