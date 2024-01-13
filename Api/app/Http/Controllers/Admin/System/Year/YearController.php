<?php

namespace App\Http\Controllers\Admin\System\Year;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Repositories\YearRepository;
use App\Http\Controllers\Admin\System\Year\Requests\{
    CreateRequest,
    UpdateRequest
};

class YearController extends Controller
{
    public function __construct(
        protected YearRepository $repository,
        protected YearRequestHandler $requestHandler,
        protected string $resource = YearResource::class,
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
