<?php

namespace App\Http\Controllers\Admin\Teacher\Register;

use App\Http\Controllers\Admin\Teacher\Register\Requests\{CreateRequest, UpdateRequest};
use App\Http\Controllers\Controller;
use App\Http\Repositories\TeacherRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(
        protected TeacherRepository $repository,
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
        $data = $this->requestHandler->set($request->validated())->handleUpdate()->get();
        return parent::update_model($request->id, $data);
    }
}
