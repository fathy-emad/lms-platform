<?php

namespace App\Models;

use App\Enums\ActiveEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RouteMenu extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        "icon" => "array",
        "ActiveEnum" => ActiveEnum::class
    ];

    public function items(): HasMany
    {
        return $this->hasMany(RouteItem::class, "menu_id");
    }

    public function titleTranslate(): BelongsTo
    {
        return $this->belongsTo(Translate::class, 'title');
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
