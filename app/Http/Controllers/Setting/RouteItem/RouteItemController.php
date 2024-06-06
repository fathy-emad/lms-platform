<?php

namespace App\Http\Controllers\Setting\RouteItem;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Setting\RouteItem\Requests\{CreateRequest, ReorderRequest, UpdateRequest};
use App\Http\Repositories\RouteItemRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RouteItemController extends Controller
{
    public function __construct(
        protected RouteItemRepository $repository,
        protected RouteItemRequestHandler $requestHandler,
        protected string $resource = RouteItemResource::class,
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

    public function reorder(ReorderRequest $request): JsonResponse
    {
        $model = $this->repository;
        return $this->requestHandler->set($request->validated())->handleReorder($model);
    }
}
