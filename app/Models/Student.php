<?php

namespace App\Models;

use App\Enums\GenderEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Student extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        "password",
        "jwtToken",
        "verifyToken"
    ];

    protected $casts = [
        "online" => "boolean",
        "image" => "array",
        'password' => 'hashed',
        "GenderEnum" => GenderEnum::class
    ];

    public function getPhonePrefixAttribute(): string
    {
        if ($this->country) return $this->country->phone_prefix;
        return "";
    }

    public function getBornAttribute($value): string
    {
       return Carbon::parse($value)->format("d/n/Y");
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'student_id');
    }

    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [
            'guard' => 'student'
        ];
    }
}
