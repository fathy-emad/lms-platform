<?php

namespace App\Http\Controllers\Setting\FAQ;

use App\Http\Controllers\Controller;
use App\Http\Repositories\FAQRepository;
use App\Http\Controllers\Setting\FAQ\Requests\{CreateRequest, UpdateRequest, DeleteRequest};
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function __construct(
        protected FAQRepository $repository,
        protected FAQRequestHandler $requestHandler,
        protected string $resource = FAQResource::class,
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
