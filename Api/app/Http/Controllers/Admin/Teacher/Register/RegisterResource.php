<?php

namespace App\Http\Controllers\Admin\Teacher\Register;

use App\Http\Resources\AuthorResource;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\TranslationResource;
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
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "country" => new TranslationResource($this->country->countryTranslate),
            "TeacherStatusEnum" => new TranslationResource($this->TeacherStatusEnum, true),
            "GenderEnum" => new TranslationResource($this->GenderEnum, true),
            "block_reason" => $this->block_reason,
            "online" => $this->online,
            "image" => $this->image,
            "contract" => $this->contract,
            "email_verified_at" => !$this->email_verified_at ?: new DateTimeResource($this->email_verified_at),
            "created_by" => new AuthorResource($this->createdBy),
            "updated_by" => !$this->updated_by ?: new AuthorResource($this->updatedBy),
            "created_at" => new DateTimeResource($this->created_at),
            "updated_at" => new DateTimeResource($this->updated_at),
        ];
    }
}
