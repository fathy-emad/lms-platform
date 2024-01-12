<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum StageEnum: string
{
    use EnumTrait;

    //do not miss if ad enum add it in stages table database  and lang files
    case Primary = "primary";
    case Preparatory = "preparatory";
    case Secondary = "secondary";
}
