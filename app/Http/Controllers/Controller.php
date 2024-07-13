<?php

namespace App\Http\Controllers;

use ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function create_model(array $data): JsonResponse
    {
        $data = $this->repository->create($data);
        return ApiResponse::sendSuccess(new $this->resource($data), "record added successfully", null);
    }

    public function read_model(Request $request): JsonResponse
    {
        if ($request->has("id")) {
            $data = $this->repository->getById($request->id);
            return ApiResponse::sendSuccess(new $this->resource($data), "record read successfully", null);

        } elseif ($request->has("per_page") && $request->has("page")){
            $data = $this->repository
                ->where($request->where)
                ->orWhere($request->orWhere)
                ->orderBy($request->orderBy)
                ->paginate($request);
            return ApiResponse::withPagination($data)->sendSuccess($this->resource::collection($data), "record read successfully", null);

        } else {
            $data = $this->repository
                ->where($request->where)
                ->orWhere($request->orWhere)
                ->orderBy($request->orderBy)
                ->skip($request->skip)
                ->take($request->take)
                ->getAll();
            return ApiResponse::sendSuccess($this->resource::collection($data), "record read successfully", null);
        }
    }

    public function update_model(int $id, array $data): JsonResponse
    {
        $data = $this->repository->update($id, $data);
        return ApiResponse::sendSuccess(new $this->resource($data), "record updated successfully", null);
    }

    public function delete_model(int $id): JsonResponse
    {
        $data = $this->repository->delete($id);
        return ApiResponse::sendSuccess(new $this->resource($data), "record deleted successfully", null);
    }
}
