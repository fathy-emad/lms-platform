<?php

namespace App\Http\Controllers\Admin\Settings\Country;

use App\Http\Controllers\Admin\Settings\Country\Requests\{UpdateRequest};
use App\Http\Controllers\Admin\Settings\Country\Requests\CreateRequest;
use App\Http\Controllers\Controller;
use App\Http\Repositories\CountryRepository;
use App\Interfaces\ApiResponseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct(
        protected ApiResponseInterface $apiResponse,
        protected CountryRepository $repository,
        protected CountryRequestHandler $requestHandler,
        protected string $resource = CountryResource::class,
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
