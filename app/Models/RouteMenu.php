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

    public function activeItems(): HasMany
    {
        return $this->items()->where("ActiveEnum", "active");
    }

    public function titleTranslate(): BelongsTo
    {
        return $this->belongsTo(Translate::class, 'title');
    }

}
