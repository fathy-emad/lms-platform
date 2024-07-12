<?php

namespace App\Models;

use App\Enums\TeacherPaymentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherPayment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        "status" => TeacherPaymentStatusEnum::class,
    ];
}
