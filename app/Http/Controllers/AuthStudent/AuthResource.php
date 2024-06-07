<?php

namespace App\Http\Controllers\AuthStudent;

use App\Http\Controllers\SettingEducation\Curriculum\CurriculumResource;
use App\Http\Controllers\SettingEducation\EduSubject\EduSubjectResource;
use App\Http\Controllers\SettingEducation\Stage\StageResource;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\TranslationResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
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
            "phonePrefix" => $this->phonePrefix,
            "name" => $this->name,
            "email" => $this->email,
            "born" => $this->born,
            "phone" => $this->phone,
            "country" => $this->country,
            "GenderEnum" => new TranslationResource($this->GenderEnum, true),
            "online" => $this->online,
            "address" => $this->address,
            "school" => $this->school,
            "image" => $this->image,
            "phone_verified_at" => $this->when($this->phone_verified_at, new DateTimeResource($this->phone_verified_at), null),
            "created_at" => new DateTimeResource($this->created_at),
            "updated_at" => new DateTimeResource($this->updated_at),
        ];
    }

    public function available_curricula()
    {
        $curricula = collect();
        $subjects = $this->stage->subjects()->where("edu_subject_id", $this->edu_subject_id)->get();
        foreach ($subjects as $subject) {
            foreach ($subject->curricula as $curriculum)  $curricula->push($curriculum);
        }
        return $curricula;
    }
}
