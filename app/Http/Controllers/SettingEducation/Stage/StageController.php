<?php

namespace App\Http\Controllers\SettingEducation\Stage;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SettingEducation\Stage\Requests\{CreateRequest, UpdateRequest, ReorderRequest};
use App\Http\Repositories\StageRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StageController extends Controller
{
    public function __construct(
        protected StageRepository $repository,
        protected StageRequestHandler $requestHandler,
        protected string $resource = StageResource::class,
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
