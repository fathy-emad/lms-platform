<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\TeacherCourseRequestStatusEnum;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        "TeacherCourseRequestStatusEnum" => TeacherCourseRequestStatusEnum::class
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, "teacher_id");
    }

    public function curriculum(): BelongsTo
    {
        return $this->belongsTo(Curriculum::class, "curriculum_id");
    }
}
