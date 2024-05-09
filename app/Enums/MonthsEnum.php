<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum MonthsEnum: int
{

    use EnumTrait;

    case Jan = 1;
    case Feb = 2;
    case Mar = 3;
    case Apr = 4;
    case May = 5;
    case Jun = 6;
    case Jul = 7;
    case Aug = 8;
    case Sep = 9;
    case Oct = 10;
    case Nov = 11;
    case Dec = 12;
}
