<?php

namespace App\Http\Controllers\SettingEducation\EduSubject;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SettingEducation\EduSubject\Requests\{CreateRequest};
use App\Http\Controllers\SettingEducation\EduSubject\Requests\UpdateRequest;
use App\Http\Repositories\EduSubjectRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class EduSubjectController extends Controller
{
    public function __construct(
        protected EduSubjectRepository $repository,
        protected EduSubjectRequestHandler $requestHandler,
        protected string $resource = EduSubjectResource::class,
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
