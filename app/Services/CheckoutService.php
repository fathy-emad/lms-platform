<?php

namespace App\Services;

use ApiResponse;
use App\Models\Cart;
use App\Models\Student;
use App\Enums\PaymentMethodEnum;
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

            $user = Student::find($data["student_id"]);
            $cartData = $this->cartItems($data["student_id"]);

            $this->service->pay($user, PaymentServiceEnum::from($data["PaymentServiceEnum"]), PaymentMethodEnum::from($data["PaymentMethodEnum"]), $cartData);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            throw new HttpResponseException(ApiResponse::sendError(["Checkout error" => [$e->getMessage()]], 'Checkout error please try again later', null));
        }
    }


    public function cartItems(int $userId): array
    {
        $total = 0;
        $items = [];
        $cartItems = Cart::where("student_id", $userId)->get();
        foreach ($cartItems as $key => $item)
        {
            $items[$key] = $item;
            $total += (float) $item->course->cost["course"];
        }

        return [
            "totalCost" => (float) $total,
            "items" => $items
        ];
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
