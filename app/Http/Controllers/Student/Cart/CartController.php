<?php

namespace App\Http\Controllers\Student\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Repositories\CartRepository;
use App\Http\Controllers\Student\Cart\Requests\{CreateRequest, DeleteRequest};

class CartController extends Controller
{
    public function __construct(
        protected CartRepository $repository,
        protected CartRequestHandler $requestHandler,
        protected string $resource = CartResource::class,
    ){}

    public function create(CreateRequest $request): JsonResponse
    {
        return parent::create_model($request->validated());
    }

    public function read(Request $request): JsonResponse
    {
        return parent::read_model($request);
    }

    public function update(UpdateRequest $request)
    {
        $this->checkoutService->pay($request->validated());
        return ApiResponse::sendSuccess([], "Checkout created successfully", null);
    }

    public function delete(DeleteRequest $request): JsonResponse
    {
        return parent::delete_model($request->id);
    }
}
