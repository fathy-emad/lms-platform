<?php

namespace App\Http\Controllers\SettingEducation\Lesson;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SettingEducation\Lesson\Requests\{UpdateRequest};
use App\Http\Controllers\SettingEducation\Lesson\Requests\CreateRequest;
use App\Http\Repositories\LessonRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function __construct(
        protected LessonRepository $repository,
        protected LessonRequestHandler $requestHandler,
        protected string $resource = LessonResource::class,
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
