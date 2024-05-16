<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum NamePrefixEnum: string
{
    //Do not miss if add any enum add it in database
    use EnumTrait;

    case Mr = 'Mr';

    case Mrs = 'Mrs';

    case Ms = 'Ms =';
    case Miss = 'Miss';

    case Dr = 'Dr';
    case Prof = 'Prof';
    case Eng = 'Eng';
    case PhD = 'PhD';
    case Sheikh = 'Sheikh';
}
