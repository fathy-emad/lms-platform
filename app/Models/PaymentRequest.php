<?php

namespace App\Models;

use App\Enums\TeacherPaymentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        "TeacherPaymentStatusEnum" => TeacherPaymentStatusEnum::class,
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, "teacher_id");
    }
}
