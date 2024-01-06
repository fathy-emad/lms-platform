<?php

namespace App\Models;

use App\Enums\ActiveEnum;
use App\Enums\EducationYearEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationYear extends Model
{
    protected $guarded = [];
    protected $casts = [
        "EducationYearEnum" => EducationYearEnum::class,
        "ActiveEnum" => ActiveEnum::class
    ];

    public function stage(): BelongsTo
    {
        return $this->belongsTo(EducationStage::class, 'stage_id');
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
