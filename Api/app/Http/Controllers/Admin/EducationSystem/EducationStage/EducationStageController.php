<?php

namespace App\Http\Controllers\Admin\EducationSystem\EducationStage;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Interfaces\ApiResponseInterface;
use App\Http\Repositories\EducationStageRepository;
use App\Http\Controllers\Admin\EducationSystem\EducationStage\Requests\{
    CreateRequest,
    UpdateRequest
};

class EducationStageController extends Controller
{
    public function __construct(
        protected ApiResponseInterface $apiResponse,
        protected EducationStageRepository $repository,
        protected EducationStageRequestHandler $requestHandler,
        protected string $resource = EducationStageResource::class,
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
