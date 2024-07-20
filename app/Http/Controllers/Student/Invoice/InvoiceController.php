<?php

namespace App\Http\Controllers\Student\Invoice;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Repositories\InvoiceRepository;
use App\Http\Controllers\Student\Invoice\Requests\{CreateRequest};

class InvoiceController extends Controller
{
    public function __construct(
        protected InvoiceRepository $repository,
        protected InvoiceRequestHandler $requestHandler,
        protected string $resource = InvoiceResource::class,
    ){}

    public function create(CreateRequest $request): JsonResponse
    {
        return parent::create_model($request->validated());
    }

    public function read(Request $request): JsonResponse
    {
        return parent::read_model($request);
    }
}
