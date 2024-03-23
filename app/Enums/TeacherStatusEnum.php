<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum TeacherStatusEnum: string
{
    use EnumTrait;

    case Pending = "pending";

    case Active = "active";
    case Blocked = "blocked";
}
