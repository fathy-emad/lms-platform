<?php

namespace App\Models;

use App\Enums\GenderEnum;
use App\Enums\NamePrefixEnum;
use App\Enums\TeacherStatusEnum;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        "prefix" => NamePrefixEnum::class,
        "online" => "boolean",
        "image" => "array",
        "contract" => "array",
        "email_verified_at" => "datetime",
        "created_at" => "datetime",
        "updated_at" => "datetime",
        'password' => 'hashed',
    ];

    public function getNameAttribute($value): string
    {
        return ucfirst(strtolower($value));
    }

    public function getPhonePrefixAttribute(): string
    {
        if ($this->country) return $this->country->phone_prefix;
        return "";
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function stage(): BelongsTo
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(EduSubject::class, 'edu_subject_id');
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
