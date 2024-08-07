<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum PaymentMethodEnum: string
{

    //donot miss if add new type add it i invoice database

    use EnumTrait;

    case Card = 'Card';
    case Wallet = 'Wallet';
    case Manual = 'Manual';
}
