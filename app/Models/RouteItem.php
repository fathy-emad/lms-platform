<?php

namespace App\Models;

use App\Enums\ActiveEnum;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RouteItem extends Model
{
    protected $guarded = [];

    protected $casts = [
        "actions" => "array",
        "icon" => "array",
        "ActiveEnum" => ActiveEnum::class
    ];

    public function setModelAttribute($value): void
    {
        $this->attributes['model'] = ucfirst($value);
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(RouteMenu::class, 'menu_id');
    }

    public function titleTranslate(): BelongsTo
    {
        return $this->belongsTo(Translate::class, 'title');
    }

}
