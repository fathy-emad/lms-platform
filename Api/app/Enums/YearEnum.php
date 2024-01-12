<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum YearEnum: string
{
    use EnumTrait;

    //do not miss if ad enum add it in years table database  and lang files

    case One = "one";
    case Two = "two";
    case Three = "three";
    case Four = "four";
    case Five = "five";
    case Six = "six";
}
