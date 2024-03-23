<?php

namespace App\Models;

use App\Enums\ActiveEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Language extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        "flag" => "array",
        "ActiveEnum" => ActiveEnum::class,
    ];

    public function setLocaleAttribute($value): void
    {
        $this->attributes['locale'] = strtolower($value);
    }

    public function languageTranslate(): BelongsTo
    {
        return $this->belongsTo(Translate::class, 'language');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
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
