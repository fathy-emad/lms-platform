<?php

namespace App\Http\Controllers\Employee\Permission;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Employee\Permission\Requests\{CreateRequest, DeleteRequest, UpdateRequest};
use App\Http\Repositories\PermissionRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct(
        protected PermissionRepository $repository,
        protected PermissionRequestHandler $requestHandler,
        protected string $resource = PermissionResource::class,
    ){}

    public function create(CreateRequest $request): JsonResponse
    {
        $data = $this->requestHandler->set($request->validated())->handleCreate()->get();
        return parent::create_model($data);
    }

    public function read(Request $request): JsonResponse
    {
        return parent::read_model($request);
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        $model = $this->repository->getById($request->id);
        $data = $this->requestHandler->set($request->validated())->handleUpdate($model)->get();
        return parent::update_model($request->id, $data);
    }

    public function delete(DeleteRequest $request): JsonResponse
    {
        return parent::delete_model($request->id);
    }
}
