<?php

namespace App\Models;

use App\Enums\ActiveEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    protected $guarded = [];

    protected $casts = [
        "cost" => "array",
        "percentage" => "float",
        "ActiveEnum" => ActiveEnum::class
    ];

    public function getCostAttribute($value)
    {
        $costArray = json_decode($value, true);
        foreach ($costArray as &$item)  $item = (float) $item;
        return $costArray;
    }

    public function curriculum(): BelongsTo
    {
        return $this->belongsTo(Curriculum::class, 'curriculum_id');
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
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
