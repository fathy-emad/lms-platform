<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum SubjectEnum: string
{
    use EnumTrait;

    //do not miss if ad enum add it in subjects table database  and lang files

    case Arabic = "arabic";
    case English = "english";
    case French = "french";
}
