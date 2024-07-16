<?php

namespace App\Http\Controllers\Teacher\PaymentRequest;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Repositories\PaymentRequestRepository;
use App\Http\Controllers\Teacher\PaymentRequest\Requests\CreateRequest;
use App\Http\Controllers\Teacher\PaymentRequest\Requests\UpdateRequest;

class PaymentRequestController extends Controller
{
    public function __construct(
        protected PaymentRequestRepository $repository,
        protected PaymentRequestHandler $requestHandler,
        protected string $resource = PaymentRequestResource::class,
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
