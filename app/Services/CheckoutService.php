<?php

namespace App\Services;

use ApiResponse;
use App\Enums\PaymentServiceEnum;
use Illuminate\Support\Facades\DB;
use App\Interfaces\CheckoutInterface;
use Illuminate\Http\Exceptions\HttpResponseException;

class CheckoutService
{
    protected CheckoutInterface $service;

    public function via($service): void
    {
        $this->service = app($service);
    }

    public function pay(array $data): void
    {
        DB::beginTransaction();
        try {

            $serviceClass = $this->resolveServiceClass($data["PaymentServiceEnum"]);
            $this->via($serviceClass);

            $this->service->pay($data);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            throw new HttpResponseException(ApiResponse::sendError(["Checkout error" => [$e->getMessage()]], 'Checkout error please try again later', null));
        }
    }

    private function resolveServiceClass(string $serviceEnum): string
    {
        return match ($serviceEnum) {
            //PaymentServiceEnum::CheckoutPaymob->value => \App\Concretes\CheckoutPaymob::class,
            PaymentServiceEnum::CheckoutManual->value => \App\Concretes\CheckoutManual::class,
            default => throw new \InvalidArgumentException("Unsupported payment service: $serviceEnum"),
        };
    }
}
