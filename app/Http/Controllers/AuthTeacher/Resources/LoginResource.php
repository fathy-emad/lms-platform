<?php

namespace App\Http\Controllers\AuthTeacher\Resources;

use App\Http\Controllers\Setting\Country\CountryResource;
use App\Http\Resources\TranslationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
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
            "country" => new CountryResource($this->country),
            "TeacherStatusEnum" => new TranslationResource($this->TeacherStatusEnum, true),
            "GenderEnum" => new TranslationResource($this->GenderEnum, true),
            "online" => $this->online,
            "image" => $this->image,
            "email_verified_at" => $this->email_verified_at,
            "jwtToken" => $this->jwtToken,
            "jwtTokenExpirationAfter" => auth('admin')->factory()->getTTL() * 60 . " seconds",
        ];
    }
}
