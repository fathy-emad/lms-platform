<?php

namespace App\Models;

use App\Enums\TeacherPaymentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherPayment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        "status" => TeacherPaymentStatusEnum::class,
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, "course_id");
    }
}
