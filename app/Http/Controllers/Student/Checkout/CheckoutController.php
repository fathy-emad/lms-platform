<?php

namespace App\Http\Controllers\Student\Checkout;

use ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\CheckoutService;
use App\Http\Controllers\Controller;
use App\Http\Repositories\CartRepository;
use App\Http\Controllers\Student\Checkout\Requests\{CreateRequest};

class CheckoutController extends Controller
{
    public function __construct(
        protected CartRepository $repository,
        protected CheckoutService $checkoutService,
        protected string $resource = CheckoutResource::class
    ){}

    public function create(CreateRequest $request): JsonResponse
    {
        $this->checkoutService->pay($request->validated());
        return ApiResponse::sendSuccess([], "Checkout created successfully", null);
    }

    public function read(Request $request): JsonResponse
    {
        return parent::read_model($request);
    }
}
