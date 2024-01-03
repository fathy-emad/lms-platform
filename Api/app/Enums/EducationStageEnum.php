<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum EducationStageEnum: string
{
    use EnumTrait;

    //do not miss if ad enum add it in education_stages table database
    case Primary = "primary";
    case Preparatory = "preparatory";
    case Secondary = "secondary";
}
