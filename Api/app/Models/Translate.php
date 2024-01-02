<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Translate extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        "translates" => "array",
    ];
}
