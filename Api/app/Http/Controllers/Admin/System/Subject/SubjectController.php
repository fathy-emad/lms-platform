<?php

namespace App\Http\Controllers\Admin\System\Subject;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Repositories\SubjectRepository;
use App\Http\Controllers\Admin\System\Subject\Requests\{
    CreateRequest,
    UpdateRequest
};

class SubjectController extends Controller
{
    public function __construct(
        protected SubjectRepository $repository,
        protected SubjectRequestHandler $requestHandler,
        protected string $resource = SubjectResource::class,
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
