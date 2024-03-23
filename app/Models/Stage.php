<?php

namespace App\Models;

use App\Enums\ActiveEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
//use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stage extends Model
{
    protected $guarded = [];
    protected $casts = [
        "ActiveEnum" => ActiveEnum::class
    ];

    public function stageEnum(): BelongsTo
    {
        return $this->belongsTo(Enumeration::class, 'StageEnumTable');
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
