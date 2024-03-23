<?php

namespace App\Http\Controllers\Employee\Register;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Employee\Register\Requests\{CreateRequest};
use App\Http\Controllers\Employee\Register\Requests\UpdateRequest;
use App\Http\Repositories\AdminRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(
        protected AdminRepository $repository,
        protected RegisterRequestHandler $requestHandler,
        protected string $resource = RegisterResource::class,
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
