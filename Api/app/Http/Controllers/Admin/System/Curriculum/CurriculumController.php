<?php

namespace App\Http\Controllers\Admin\System\Curriculum;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Repositories\CurriculumRepository;
use App\Http\Controllers\Admin\System\Curriculum\Requests\{
    CreateRequest,
    UpdateRequest
};

class CurriculumController extends Controller
{
    public function __construct(
        protected CurriculumRepository $repository,
        protected CurriculumRequestHandler $requestHandler,
        protected string $resource = CurriculumResource::class,
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
