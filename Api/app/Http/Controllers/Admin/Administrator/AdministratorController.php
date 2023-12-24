<?php

namespace App\Http\Controllers\Admin\Administrator;

use App\Http\Controllers\Admin\Administrator\Requests\CreateRequest;
use App\Http\Controllers\Admin\Administrator\Requests\DeleteRequest;
use App\Http\Controllers\Admin\Administrator\Requests\UpdateRequest;
use App\Http\Controllers\Controller;
use App\Http\Repositories\AdminRepository;
use App\Interfaces\ApiResponseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function __construct(
        protected ApiResponseInterface $apiResponse,
        protected AdminRepository $repository,
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
        $data = $this->requestHandler->handleUpdate($request->validated());
        return parent::update_model($request->id, $data);
    }

    public function delete(DeleteRequest $request): JsonResponse
    {
        return parent::delete_model($request->id);
    }
}
