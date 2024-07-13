<?php

namespace App\Http\Controllers\Teacher\Payments;

use ApiResponse;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Repositories\TeacherPaymentRepository;
use App\Http\Controllers\Teacher\Payments\Requests\ReadRequest;


class PaymentsController extends Controller
{
    public function __construct(
        protected TeacherPaymentRepository $repository,
        protected PaymentsHandler $requestHandler,
        protected string $resource = PaymentsResource::class,
    ){}

    public function read(ReadRequest $request): JsonResponse
    {
        $data = $this->repository->where($request->where)->getAll();
        return ApiResponse::sendSuccess(new $this->resource($data), "record added successfully", null);
    }

}
