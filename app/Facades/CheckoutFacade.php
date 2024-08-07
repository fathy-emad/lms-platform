<?php

namespace App\Facades;

use App\Services\CheckoutService;
use Illuminate\Support\Facades\Facade;

class CheckoutFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CheckoutService::class;
    }
}
