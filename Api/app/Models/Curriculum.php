<?php

namespace App\Models;

use App\Enums\ActiveEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
use Staudenmeir\EloquentJsonRelations\Relations\BelongsToJson;

class Curriculum extends Model
{
    use HasFactory, HasJsonRelationships;
    protected $guarded = [];
    protected $casts = [
        "termsEnumTable" => "array",
        "typesEnumTable" => "array",
        "ActiveEnum" => ActiveEnum::class,
        "priority" => "integer"
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function curriculumEnum(): BelongsTo
    {
        return $this->belongsTo(Enumeration::class, 'CurriculumEnumTable');
    }

    public function termsEnums(): BelongsToJson
    {
        return $this->belongsToJson(Enumeration::class, 'termsEnumTable');
    }

    public function typesEnums(): BelongsToJson
    {
        return $this->belongsToJson(Enumeration::class, 'termsEnumTable');
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
