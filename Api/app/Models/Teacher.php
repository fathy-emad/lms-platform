<?php

namespace App\Models;

use App\Enums\GenderEnum;
use App\Enums\TeacherStatusEnum;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Teacher extends Authenticatable implements JWTSubject
{
    protected $guarded = [];

    protected $hidden = [
        "password",
        "jwtToken",
        "verifyToken"
    ];

    protected $casts = [
        "GenderEnum" => GenderEnum::class,
        "TeacherStatusEnum" => TeacherStatusEnum::class,
        "online" => "boolean",
        "image" => "array",
        "contract" => "array",
        "email_verified_at" => "datetime",
        "created_at" => "datetime",
        "updated_at" => "datetime",
        'password' => 'hashed',
    ];

    public function setNamePrefixEnumTableAttribute($value): string
    {
        return ucfirst(strtolower($value));
    }

    public function getPhoneAttribute($value): string
    {
        if ($this->country) return "(" . $this->country->phone_prefix . ") " . $value;

        return $value;
    }

    public function getNameAttribute($value): string
    {
        if ($this->namePrefixEnum) return $this->namePrefixEnum->valueTranslate[app()->getLocale()] . "." . $value;

        return $value;
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function namePrefixEnum(): BelongsTo
    {
        return $this->belongsTo(Enumeration::class, 'NamePrefixEnumTable');
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
