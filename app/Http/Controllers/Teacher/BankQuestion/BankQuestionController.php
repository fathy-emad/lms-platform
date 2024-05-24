<?php

namespace App\Http\Controllers\Teacher\BankQuestion;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Repositories\BankQuestionRepository;
use App\Http\Controllers\Teacher\BankQuestion\Requests\CreateRequest;
use App\Http\Controllers\Teacher\BankQuestion\Requests\UpdateRequest;

class BankQuestionController extends Controller
{
    public function __construct(
        protected BankQuestionRepository $repository,
        protected BankQuestionRequestHandler $requestHandler,
        protected string $resource = BankQuestionResource::class,
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

    public function delete(Request $request): JsonResponse
    {
        return parent::delete_model($request->id);
    }
}
