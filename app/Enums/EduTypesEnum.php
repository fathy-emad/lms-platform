<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum EduTypesEnum: string
{
    use EnumTrait;

    case General = "general";
    case Languages = "languages";
    case IG = "ig";
    case Azhar = "azhar";
}
