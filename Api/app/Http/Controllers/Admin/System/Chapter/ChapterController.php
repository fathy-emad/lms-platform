<?php

namespace App\Http\Controllers\Admin\System\Chapter;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Repositories\ChapterRepository;
use App\Http\Controllers\Admin\System\Chapter\Requests\{
    CreateRequest,
    UpdateRequest
};

class ChapterController extends Controller
{
    public function __construct(
        protected ChapterRepository $repository,
        protected ChapterRequestHandler $requestHandler,
        protected string $resource = ChapterResource::class,
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
