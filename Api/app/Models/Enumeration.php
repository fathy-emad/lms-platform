<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enumeration extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setKeyAttribute($value): void
    {
        $this->attributes['key'] = strtolower(str_replace(" ", "_", trim($value)));
    }

    public function valueTranslate(): BelongsTo
    {
        return $this->belongsTo(Translate::class, 'value');
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
