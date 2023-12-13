<?php

namespace app\Concretes;

use App\Interfaces\Api\ApiResponseInterface;
use Illuminate\Http\JsonResponse;

class ApiResponse implements ApiResponseInterface
{
    public function handle(int $status_code, ?array $messages, ?array $data = null): array
    {
        $return = [];
        $return["status_code"] = $status_code ?: 404;
        $return["success"] = $status_code >= 200 && $status_code < 300;
        $return["message"] = $messages;
        $return["data"] = $data;
        return $return;
    }

    public function send(int $status_code, ?array $messages, ?array $data, ?array $headers): JsonResponse
    {
        $response = $this->handle($status_code, $messages, $data);
        return response()->json($response)->withHeaders($headers ?? []);
    }
}
