<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum PaymentServiceEnum: string
{
    //donot miss if add new type add it i invoice database

    use EnumTrait;

    case CheckoutPaymob = 'CheckoutPaymob';
    case CheckoutPaytabs = 'CheckoutPaytabs';
    case CheckoutManual = 'CheckoutManual';
}
