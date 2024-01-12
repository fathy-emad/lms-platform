<?php

namespace App\Models;

use App\Enums\ActiveEnum;
use App\Enums\YearEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Year extends Model
{
    protected $guarded = [];
    protected $casts = [
        "YearEnum" => YearEnum::class,
        "ActiveEnum" => ActiveEnum::class
    ];

    public function stage(): BelongsTo
    {
        return $this->belongsTo(Stage::class, 'stage_id');
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
