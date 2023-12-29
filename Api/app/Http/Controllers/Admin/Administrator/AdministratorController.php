<?php

namespace App\Http\Controllers\Admin\Administrator;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Interfaces\ApiResponseInterface;
use App\Http\Repositories\AdministratorRepository;
use App\Http\Controllers\Admin\Administrator\Requests\{ CreateRequest, UpdateRequest };

class AdministratorController extends Controller
{
    public function __construct(
        protected ApiResponseInterface $apiResponse,
        protected AdministratorRepository $repository,
        protected AdministratorRequestHandler $requestHandler,
        protected string $resource = AdministratorResource::class,
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
        $data = $this->requestHandler->set($request->validated())->handleUpdate()->get();
        return parent::update_model($request->id, $data);
    }
}
