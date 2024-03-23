<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum GenderEnum: string
{
    use EnumTrait;
    case Male = "male";
    case Female = "female";
}
