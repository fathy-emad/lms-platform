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

    public function pay(array $data)
    {
        DB::beginTransaction();
        try {

            $serviceClass = $this->resolveServiceClass($data["PaymentServiceEnum"]);
            $this->via($serviceClass);
            $return = $this->service->pay($data);
            DB::commit();
            return $return;

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
            PaymentServiceEnum::CheckoutPaytabs->value => \App\Concretes\CheckoutPaytabs::class,
            default => throw new \InvalidArgumentException("Unsupported payment service: $serviceEnum"),
        };
    }
}
