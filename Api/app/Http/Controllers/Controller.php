<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use ApiResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function create_model(array $data): JsonResponse
    {
        $data = $this->repository->create($data);
        if($data instanceof Model) return ApiResponse::sendSuccess(new $this->resource($data), "record added successfully", null);
        return ApiResponse::sendError([$data], "some thing went wrong", null);
    }

    public function read_model(Request $request): JsonResponse
    {
        if ($request->has("id"))
        {
            $data = $this->repository->getById($request->id);
            if($data instanceof Model) return ApiResponse::sendSuccess(new $this->resource($data), "record read successfully", null);
        }
        else
        {
            $data = $this->repository->getAll();
            if($data instanceof Collection) return ApiResponse::sendSuccess($this->resource::collection($data), "record read successfully", null);
        }
        return ApiResponse::sendError([$data], "some thing went wrong", null);
    }

    public function update_model(int $id, array $data): JsonResponse
    {
        $data = $this->repository->update($id, $data);
        if($data instanceof Model) return ApiResponse::sendSuccess(new $this->resource($data), "record updated successfully", null);
        return ApiResponse::sendError([$data], "some thing went wrong", null);
    }

    public function delete_model(int $id): JsonResponse
    {
        $data = $this->repository->delete($id);
        if($data instanceof Model) return ApiResponse::sendSuccess(new $this->resource($data), "record deleted successfully", null);
        return ApiResponse::sendError([$data], "some thing went wrong", null);
    }
}
