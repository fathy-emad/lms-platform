<?php

namespace App\Models;

use App\Enums\MonthsEnum;
use App\Enums\ActiveEnum;
use App\Enums\EduTermsEnum;
use App\Enums\EduTypesEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curriculum extends Model
{
    protected $guarded = [];
    protected $casts = [
        "EduTermsEnums" => AsEnumCollection::class.':'.EduTermsEnum::class,
        "EduTypesEnums" => AsEnumCollection::class.':'.EduTypesEnum::class,
        "from" => MonthsEnum::class,
        "to" => MonthsEnum::class,
        "ActiveEnum" => ActiveEnum::class,
        "priority" => "integer"
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function curriculumTranslate(): BelongsTo
    {
        return $this->belongsTo(Translate::class, 'curriculum');
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, "curriculum_id");
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
