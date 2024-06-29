<?php

namespace App\Facades;

use App\Services\PaymobService;
use Illuminate\Support\Facades\Facade;
class PaymobFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return PaymobService::class;
    }
}
