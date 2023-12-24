<?php

namespace App\Models;

use App\Enums\ActiveEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Country extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        "flag" => "array",
        "ActiveEnum" => ActiveEnum::class
    ];

    public function countryTranslate(): BelongsTo
    {
        return $this->belongsTo(Translate::class, 'country');
    }

    public function currencyTranslate(): BelongsTo
    {
        return $this->belongsTo(Translate::class, 'currency');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
