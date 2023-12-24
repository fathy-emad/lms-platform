<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum AdminRoleEnum: string
{
    use EnumTrait;

    case Administrator = 'admin';
}
