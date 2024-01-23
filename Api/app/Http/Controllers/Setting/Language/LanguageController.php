<?php

namespace App\Http\Controllers\Setting\Language;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Setting\Language\Requests\{CreateRequest};
use App\Http\Controllers\Setting\Language\Requests\UpdateRequest;
use App\Http\Repositories\LanguageRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function __construct(
        protected LanguageRepository $repository,
        protected LanguageRequestHandler $requestHandler,
        protected string $resource = LanguageResource::class,
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
