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
        if($data instanceof Model) return ApiResponse::sendSuccess(new $this->resource($data), "record added successfully", null);
        return ApiResponse::sendError([$data], "some thing went wrong", null);
    }

    public function read_model(Request $request): JsonResponse
    {
        if ($request->has("id")) {
            $data = $this->repository->getById($request->id);
            if($data instanceof Model) return ApiResponse::sendSuccess(new $this->resource($data), "record read successfully", null);
            return ApiResponse::sendError(["some thing went wrong to get record"], $data, null);

        } elseif ($request->has("per_page") && $request->has("page")){
            $data = $this->repository
                ->where($request->where)
                ->orderBy($request->orderBy)
                ->paginate($request);

            if($data instanceof LengthAwarePaginator) return ApiResponse::withPagination($data)->sendSuccess( $this->resource::collection($data), "record read successfully", null);
            return ApiResponse::sendError(["some thing went wrong to get paginated data"], "some thing went wrong", null);

        } else {
            $data = $this->repository
                ->where($request->where)
                ->orderBy($request->orderBy)
                ->skip($request->skip)
                ->take($request->take)
                ->getAll();
            if($data instanceof Collection) return ApiResponse::sendSuccess($this->resource::collection($data), "record read successfully", null);
            return ApiResponse::sendError(["some went wrong to get records"], "some thing went wrong", null);
        }
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
