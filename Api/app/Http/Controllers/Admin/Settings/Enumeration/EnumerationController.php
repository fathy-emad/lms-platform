<?php

namespace App\Http\Controllers\Admin\Settings\Enumeration;

use App\Http\Controllers\Admin\Settings\Enumeration\Requests\{CreateRequest, UpdateRequest};
use App\Http\Controllers\Controller;
use App\Http\Repositories\EnumerationRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnumerationController extends Controller
{
    public function __construct(
        protected EnumerationRepository $repository,
        protected EnumerationRequestHandler $requestHandler,
        protected string $resource = EnumerationResource::class,
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
}
