<?php

namespace App\Http\Controllers\Teacher\CourseRequest;


use App\Enums\TeacherCourseRequestStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Repositories\CourseRequestRepository;
use App\Http\Controllers\Teacher\CourseRequest\Requests\CreateRequest;
use App\Http\Controllers\Teacher\CourseRequest\Requests\UpdateRequest;

class CourseRequestController extends Controller
{
    public function __construct(
        protected CourseRequestRepository $repository,
        protected CourseRequestHandler $requestHandler,
        protected string $resource = CourseRequestResource::class,
    ){}

    public function create(CreateRequest $request): JsonResponse
    {
        return parent::create_model($request->validated());
    }

    public function read(Request $request): JsonResponse
    {
        return parent::read_model($request);
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        if ($request->TeacherCourseRequestStatusEnum == TeacherCourseRequestStatusEnum::Approved->value)
            $this->requestHandler->set($request->validated())->addNewCourse();

        return parent::update_model($request->id, $request->validated());
    }

}
