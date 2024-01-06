<?php

namespace App\Http\Controllers\Admin\EducationSystem\EducationYear;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Interfaces\ApiResponseInterface;
use App\Http\Repositories\EducationYearRepository;
use App\Http\Controllers\Admin\EducationSystem\EducationYear\Requests\{
    CreateRequest,
    UpdateRequest
};

class EducationYearController extends Controller
{
    public function __construct(
        protected ApiResponseInterface $apiResponse,
        protected EducationYearRepository $repository,
        protected EducationYearRequestHandler $requestHandler,
        protected string $resource = EducationYearResource::class,
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
