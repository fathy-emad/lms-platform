<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum StudentStatusEnum: string
{
    use EnumTrait;

    case Active = "active";
    case Blocked = "blocked";
}
