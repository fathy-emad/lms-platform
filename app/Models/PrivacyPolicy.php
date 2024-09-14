<?php

namespace App\Models;

use App\Enums\ActiveEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrivacyPolicy extends Model
{
    use HasFactory;


    protected $guarded = [];

    protected $casts = [
        "ActiveEnum" => ActiveEnum::class
    ];

    public function headerTranslate(): BelongsTo
    {
        return $this->belongsTo(Translate::class, "header");
    }

    public function bodyTranslate(): BelongsTo
    {
        return $this->belongsTo(Translate::class, "body");
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, "created_by");
    }


    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, "updated_by");
    }
}
