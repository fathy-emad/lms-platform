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
        "methods" => "array",
        "icon" => "array",
        "read_all" => "boolean",
        "update_all" => "boolean",
        "ActiveEnum" => ActiveEnum::class
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(RouteMenu::class, 'menu_id');
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
