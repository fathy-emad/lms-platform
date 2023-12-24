<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum ActiveEnum: string
{
    use EnumTrait;

    case Active = "active";
    case NotActive = "notActive";
}
