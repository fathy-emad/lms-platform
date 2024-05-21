<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum FreeEnum: string
{
    use EnumTrait;

    case Free = 'free';
    case NotFree = 'notFree';
}
