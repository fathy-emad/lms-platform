<?php

namespace App\Models;

use App\Enums\AdminRoleEnum;
use App\Enums\AdminStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admin extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [
        "password",
        "jwtToken",
        "verifyToken"
    ];
    protected $casts = [
        "roleEnum" => AdminRoleEnum::class,
        "statusEnum" => AdminStatusEnum::class,
        "online" => "boolean",
        "image" => "array",
        "address" => "array",
        "email_verified_at" => "datetime",
        "created_at" => "datetime",
        "updated_at" => "datetime",
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by', 'id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by', 'id');
    }
}
