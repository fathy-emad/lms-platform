<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Translate extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setKeyAttribute($value): void
    {
        $this->attributes['key'] = strtolower(str_replace(" ", "_", trim($value)));
    }

    protected $casts = [
        "translates" => "array",
    ];
}
