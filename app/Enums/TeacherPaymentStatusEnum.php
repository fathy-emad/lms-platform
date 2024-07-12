<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum TeacherPaymentStatusEnum: string
{
    use EnumTrait;

    case Pending = "pending";
    case INReview = "in-review";
    case ONWay = "on-way";
    case Paid = "paid";
}
