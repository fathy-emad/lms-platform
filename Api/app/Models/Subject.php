<?php

namespace App\Models;

use App\Enums\ActiveEnum;
use App\Enums\SubjectEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subject extends Model
{
    protected $guarded = [];
    protected $casts = [
        "SubjectEnum" => SubjectEnum::class,
        "terms" => "boolean",
        "ActiveEnum" => ActiveEnum::class
    ];

    public function year(): BelongsTo
    {
        return $this->belongsTo(Year::class, 'year_id');
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
