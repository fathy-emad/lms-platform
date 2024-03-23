<?php

namespace App\Models;

use App\Enums\ActiveEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    protected $guarded = [];
    protected $casts = [
        "ActiveEnum" => ActiveEnum::class
    ];

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }

    public function lessonEnum(): BelongsTo
    {
        return $this->belongsTo(Enumeration::class, 'LessonEnumTable');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }
}
