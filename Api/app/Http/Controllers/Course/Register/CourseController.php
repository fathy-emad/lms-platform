<?php

namespace App\Http\Controllers\Course\Register;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Course\Register\Requests\{CreateRequest, UpdateRequest};
use App\Http\Repositories\CourseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct(
        protected CourseRepository $repository,
        protected CourseRequestHandler $requestHandler,
        protected string $resource = CourseResource::class,
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
