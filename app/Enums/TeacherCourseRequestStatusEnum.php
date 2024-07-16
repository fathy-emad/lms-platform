<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum TeacherCourseRequestStatusEnum: string
{
    use EnumTrait;

    case Pending = "pending";
    case Approved = "approved";
    case Rejected = "rejected";

}
