<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Enrollment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, "payment_id");
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, "course_id");
    }
}
