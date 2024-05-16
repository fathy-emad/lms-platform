<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EduSubject extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subjectTranslate(): BelongsTo
    {
        return $this->belongsTo(Translate::class, 'subject');
    }
}
