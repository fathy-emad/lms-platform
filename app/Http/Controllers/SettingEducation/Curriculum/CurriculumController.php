<?php

namespace App\Http\Controllers\SettingEducation\Curriculum;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SettingEducation\Curriculum\Requests\{UpdateRequest};
use App\Http\Controllers\SettingEducation\Curriculum\Requests\CreateRequest;
use App\Http\Repositories\CurriculumRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        $model = $this->repository->getById($request->id);
        $data = $this->requestHandler->set($request->validated())->handleUpdate($model)->get();
        return parent::update_model($request->id, $data);
    }
}
