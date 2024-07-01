<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum TeacherPaymentStatusEnum: string
{
    use EnumTrait;

    case Pending = "pending";
    case Review = "review";
    case Rejected = "rejected";
    case Paid = "paid";
}
