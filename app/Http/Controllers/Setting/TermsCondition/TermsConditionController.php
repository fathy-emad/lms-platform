<?php

namespace App\Http\Controllers\Setting\TermsCondition;

use App\Http\Controllers\Controller;
use App\Http\Repositories\TermsConditionRepository;
use App\Http\Controllers\Setting\TermsCondition\Requests\{CreateRequest, UpdateRequest, DeleteRequest};
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TermsConditionController extends Controller
{
    public function __construct(
        protected TermsConditionRepository $repository,
        protected TermsConditionRequestHandler $requestHandler,
        protected string $resource = TermsConditionResource::class,
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
