<?php

namespace App\Models;

use App\Enums\FreeEnum;
use App\Enums\ActiveEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Staudenmeir\EloquentJsonRelations\Relations\BelongsToJson;

class Material extends Model
{
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

    protected $guarded = [];
    protected $casts = [
        "images" => "array",
        "files" => "array",
        "assignment" => "array",
        "FreeEnum" => FreeEnum::class,
        "ActiveEnum" => ActiveEnum::class
    ];

    public function descriptionTranslate(): BelongsTo
    {
        return $this->belongsTo(Translate::class, "description");
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, "course_id");
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class, "lesson_id");
    }


    public function questions(): BelongsToJson
    {
        return $this->belongsToJson(BankQuestion::class, "assignment");
    }
}
