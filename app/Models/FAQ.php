<?php

namespace App\Models;

use App\Enums\ActiveEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FAQ extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = "faqs";

    protected $casts = [
        "ActiveEnum" => ActiveEnum::class
    ];

    public function questionTranslate(): BelongsTo
    {
        return $this->belongsTo(Translate::class, "question");
    }

    public function answerTranslate(): BelongsTo
    {
        return $this->belongsTo(Translate::class, "answer");
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
