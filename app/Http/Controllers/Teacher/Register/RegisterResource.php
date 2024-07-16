<?php

namespace App\Http\Controllers\Teacher\Register;

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
            "teacher" => [
                "id" => $this->id,
                "prefix" => $this->prefix->value,
                "name" => $this->name,
                "image" => $this->image,
                "curricula" => CurriculumResource::collection($this->available_curricula()),
            ],
            default => [
                "id" => $this->id,
                "prefix" => $this->prefix->value,
                "name" => $this->name,
                "email" => $this->email,
                "phonePrefix" => $this->phonePrefix,
                "phone" => $this->phone,
                "country" => $this->country,
                "TeacherStatusEnum" => new TranslationResource($this->TeacherStatusEnum, true),
                "GenderEnum" => new TranslationResource($this->GenderEnum, true),
                "block_reason" => $this->block_reason,
                "online" => $this->online,
                "image" => $this->image,
                "contract" => $this->contract,
                "stage" => new StageResource($this->stage),
                "subject" => new EduSubjectResource($this->subject),
                "curricula" => CurriculumResource::collection($this->available_curricula()),
                "email_verified_at" => $this->when($this->email_verified_at, new DateTimeResource($this->email_verified_at), null),
                "created_by" => new AuthorResource($this->createdBy),
                "updated_by" => $this->when($this->updatedBy, new AuthorResource($this->updatedBy), null),
                "created_at" => new DateTimeResource($this->created_at),
                "updated_at" => new DateTimeResource($this->updated_at),
            ]
        };

        return $return;
    }

    public function available_curricula()
    {
        $curricula = collect();
        $subjects = $this->stage->subjects()->where("edu_subject_id", $this->edu_subject_id)->get();
        foreach ($subjects as $subject) {
            foreach ($subject->curricula as $curriculum) $curricula->push($curriculum);
        }
        return $curricula;
    }
}
