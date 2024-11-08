<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum PaymentStatusEnum: string
{
    //donot miss if add new type add it i invoice database

    use EnumTrait;

    case Pending = 'pending';
    case Failed = 'failed';
    case Success = 'success';
}
