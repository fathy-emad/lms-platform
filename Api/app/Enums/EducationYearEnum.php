<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum EducationYearEnum: string
{
    use EnumTrait;

    //do not miss if ad enum add it in education_years table database

    case One = "one";
    case Two = "two";
    case Three = "three";
    case Four = "four";
    case Five = "five";
    case Six = "six";
}
