<?php

namespace App\Models;

use App\Enums\ActiveEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Year extends Model
{
    protected $guarded = [];
    protected $casts = [
        "ActiveEnum" => ActiveEnum::class
    ];

    public function stage(): BelongsTo
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }

    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class, "year_id");
    }

    public function curricula(): HasManyThrough
    {
        return $this->hasManyThrough(Curriculum::class,Subject::class,"year_id","subject_id","id","id");
    }

    public function yearTranslate(): BelongsTo
    {
        return $this->belongsTo(Translate::class, 'year');
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
