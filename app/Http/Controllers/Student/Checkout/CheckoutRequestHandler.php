<?php

namespace App\Http\Controllers\Student\Checkout;

use App\Models\Cart;
use App\Services\PaymobService;
use App\Concretes\RequestHandler;
use App\Enums\PaymentServiceEnum;

class CheckoutRequestHandler extends RequestHandler
{

    public function __construct(protected PaymobService $paymobService){}

    public function handleCreate(): static
    {
        return $this;
    }

    public function handleUpdate(): static
    {
        return $this;
    }

    //Get Cart items
    public function cartItems(): array
    {
        $total = 0;
        $items = [];
        $cartItems = Cart::where("student_id", auth("student")->id())->get();
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

    public function checkout($request): string
    {
        $totalCost = (float) $this->cartItems()["totalCost"];
        return $this->paymobService->pay($totalCost, $request["paymentMethod"]);
//        if ($request["paymentService"] == PaymentServiceEnum::Paymob->value) {
//            return $this->paymobService->pay($totalCost, $request["paymentMethod"]);
//        }

    }
}
