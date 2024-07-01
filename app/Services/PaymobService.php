<?php

namespace App\Services;

use ApiResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Exceptions\HttpResponseException;

class PaymobService
{
    protected int $iframeId;

    protected string $apiKey;
    protected string $authToken;
    protected array $orderData;

    protected string $paymentKey;

    public function __construct()
    {
        $this->apiKey = env('PAYMOB_APIKEY');
        $this->iframeId = env('PAYMOB_IFRAME_ID');
    }

    public function pay($totalCost, $paymentMethod)
    {
        $this->authenticate();
        $this->createOrder($totalCost);
        $this->paymentKey($paymentMethod);
        return $this->paymentIframe();
    }

    public function authenticate(): void
    {
        $response = Http::post('https://accept.paymob.com/api/auth/tokens', ['api_key' => $this->apiKey,]);

        if ($response->successful())
            $this->authToken = $response->json()['token'];

        else
            throw new HttpResponseException(ApiResponse::sendError(["Something went wrong" => ["checkout error please try again later"]], 'Paymob authentication Checkout Error please try again later', null));
    }

    public function createOrder($amount): void
    {
        $response = Http::withToken($this->authToken)->post('https://accept.paymob.com/api/ecommerce/orders', [
            'auth_token' => $this->authToken,
            'delivery_needed' => false,
            'amount_cents' => $amount * 100,
            'currency' => 'EGP',
            'items' => [],
            'merchant_order_id' => auth("student")->id()."-".time(),
        ]);

        if ($response->successful())
            $this->orderData = $response->json();

        else
            throw new HttpResponseException(ApiResponse::sendError(["Something went wrong" => ["checkout error please try again later"]], 'Paymob create order Checkout Error please try again later', null));
    }

    public function studentBillingData(): array
    {
        $student = auth("student")->user();
        return [
            "first_name" => $student->name,
            "last_name" => $student->name,
            "email" => $student->email,
            "phone_number" => $student->country->phone_prefix . $student->phone,
            'apartment' => '4',
            'floor' => '2',
            'street' => 'hassan',
            'building' => '4',
            'city' => 'giza',
            'state' => 'badrashien',
            'country' => $student->country->symbol,
        ];
    }

    public function integrationId($paymentMethod)
    {
        return $paymentMethod === "card" ? env("PAYMOB_INTEGRATION_ID_CARD") : env("PAYMOB_INTEGRATION_ID_WALLET");
    }

    public function paymentKey($paymentMethod): void
    {
        $response = Http::withToken($this->authToken)->post('https://accept.paymob.com/api/acceptance/payment_keys', [
            'auth_token' => $this->authToken,
            'amount_cents' => (float) $this->orderData["amount_cents"],
            'expiration' => 3600,
            'order_id' => $this->orderData["id"],
            'billing_data' => $this->studentBillingData(),
            'currency' => 'EGP',
            'integration_id' => $this->integrationId($paymentMethod),
        ]);

        if ($response->successful())
            $this->paymentKey = $response->json()['token'];

        else
            throw new HttpResponseException(ApiResponse::sendError(["Something went wrong" => ["checkout error please try again later"]], 'Paymob create iframe Checkout Error please try again later', null));
    }

    public function paymentIframe(): string
    {
        $paymentUrl = "https://accept.paymob.com/api/acceptance/iframes/{$this->iframeId}?payment_token={$this->paymentKey}";
        return $paymentUrl;
    }

}

