<?php

namespace App\Http\Controllers\Teacher\PaymentRequest;

use App\Http\Controllers\SettingEducation\Curriculum\CurriculumResource;
use App\Http\Controllers\SettingEducation\Lesson\LessonResource;
use App\Http\Controllers\Teacher\Register\RegisterResource;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\TranslationResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentRequestResource extends JsonResource
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
            "teacher" => new RegisterResource($this->teacher),
            "totalAmount" => $this->totalAmount,
            "countItems" => $this->countItems,
            "TeacherPaymentStatusEnum" => new TranslationResource($this->TeacherPaymentStatusEnum, true),
            "ActiveEnum" => new TranslationResource($this->ActiveEnum, true),
            "created_at" => new DateTimeResource($this->created_at),
            "updated_at" => new DateTimeResource($this->updated_at),
        ];
    }
}
