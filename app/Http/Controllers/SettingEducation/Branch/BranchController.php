<?php

namespace App\Http\Controllers\SettingEducation\Branch;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SettingEducation\Branch\Requests\{CreateRequest};
use App\Http\Controllers\SettingEducation\Branch\Requests\UpdateRequest;
use App\Http\Repositories\BranchRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function __construct(
        protected BranchRepository $repository,
        protected BranchRequestHandler $requestHandler,
        protected string $resource = BranchResource::class,
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
