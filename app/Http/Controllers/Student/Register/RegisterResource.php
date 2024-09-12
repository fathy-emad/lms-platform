<?php

namespace App\Http\Controllers\Student\Register;

use App\Http\Controllers\Setting\Country\CountryResource;
use App\Http\Controllers\SettingEducation\Curriculum\CurriculumResource;
use App\Http\Controllers\SettingEducation\EduSubject\EduSubjectResource;
use App\Http\Controllers\SettingEducation\Stage\StageResource;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\TranslationResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $return = match ($request->attributes->get('guard')) {
            "student" => [
                "id" => $this->id,
                "phonePrefix" => $this->phonePrefix,
                "name" => $this->name,
                "email" => $this->email,
                "born" => $this->born,
                "phone" => $this->phone,
                "country" => new CountryResource($this->country),
                "GenderEnum" => new TranslationResource($this->GenderEnum, true),
                "StudentStatusEnum" => new TranslationResource($this->StudentStatusEnum, true),
                "block_reason" => $this->block_reason,
                "address" => $this->address,
                "school" => $this->school,
                "image" => $this->image,
            ],
            default => [
                "id" => $this->id,
                "phonePrefix" => $this->phonePrefix,
                "name" => $this->name,
                "email" => $this->email,
                "born" => $this->born,
                "phone" => $this->phone,
                "country" => new CountryResource($this->country),
                "GenderEnum" => new TranslationResource($this->GenderEnum, true),
                "StudentStatusEnum" => new TranslationResource($this->StudentStatusEnum, true),
                "block_reason" => $this->block_reason,
                "address" => $this->address,
                "school" => $this->school,
                "image" => $this->image,
                "created_at" => new DateTimeResource($this->created_at),
                "updated_at" => new DateTimeResource($this->updated_at),
            ]
        };

        return $return;
    }
}
