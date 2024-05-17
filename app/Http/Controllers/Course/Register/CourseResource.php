<?php

namespace App\Http\Controllers\Course\Register;

use App\Http\Controllers\SettingEducation\Curriculum\CurriculumResource;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\TranslationResource;
use App\Models\Curriculum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "teacher" => $this->teacher,
            "curriculum" => new CurriculumResource($this->curriculum),
            "cost" => $this->cost,
            "percentage" => $this->percentage,
            "ActiveEnum" => new TranslationResource($this->ActiveEnum, true),
            "created_by" => new AuthorResource($this->createdBy),
            "updated_by" => $this->when($this->updatedBy, new AuthorResource($this->updatedBy), null),
            "created_at" => new DateTimeResource($this->created_at),
            "updated_at" => new DateTimeResource($this->updated_at),
        ];
    }
}
