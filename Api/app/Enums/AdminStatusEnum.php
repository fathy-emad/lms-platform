<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum AdminStatusEnum: string
{
    use EnumTrait;
    case Pending = "pending";
    case Active = "active";
    case Blocked = "blocked";
}
