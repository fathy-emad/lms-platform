<?php

namespace App\Http\Controllers\Student\Checkout;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Repositories\CartRepository;
use App\Http\Controllers\Student\Checkout\Requests\{CreateRequest};

class CheckoutController extends Controller
{
    public function __construct(
        protected CartRepository $repository,
        protected CheckoutRequestHandler $requestHandler,
        protected string $resource = CheckoutResource::class
    ){}

    public function create(CreateRequest $request): string
    {
        return $this->requestHandler->checkout($request->validated());
    }

    public function read(Request $request): JsonResponse
    {
        return parent::read_model($request);
    }

    public function callback(Request $request)
    {

    }
}
