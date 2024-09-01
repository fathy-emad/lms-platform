<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function enrollment(): HasOne
    {
        return $this->hasOne(Enrollment::class, "payment_id");
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, "course_id");
    }
}
