<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Enums\AdminRoleEnum;
use App\Enums\AdminStatusEnum;
use App\Enums\GenderEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        "password",
        "jwtToken",
        "verifyToken"
    ];

    protected $casts = [
        "AdminRoleEnum" => AdminRoleEnum::class,
        "GenderEnum" => GenderEnum::class,
        "AdminStatusEnum" => AdminStatusEnum::class,
        "online" => "boolean",
        "image" => "array",
        "address" => "array",
        "email_verified_at" => "datetime",
        "created_at" => "datetime",
        "updated_at" => "datetime",
        'password' => 'hashed',
    ];

    public function getPhonePrefixAttribute(): string
    {
        if ($this->country) return $this->country->phone_prefix;
        return "";
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function permission(): HasOne
    {
        return $this->hasOne(Permission::class, 'admin_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
