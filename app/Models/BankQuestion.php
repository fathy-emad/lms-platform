<?php

namespace App\Models;

use App\Enums\ActiveEnum;
use App\Enums\QuestionTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankQuestion extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        "answers" => "array",
        "images" => "array",
        "QuestionTypeEnum" => QuestionTypeEnum::class,
        "ActiveEnum" => ActiveEnum::class
    ];
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
}
