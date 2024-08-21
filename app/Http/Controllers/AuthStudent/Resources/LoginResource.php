<?php

namespace App\Http\Controllers\AuthStudent\Resources;

use App\Http\Controllers\Employee\Permission\PermissionResource;
use App\Http\Controllers\Setting\Country\CountryResource;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\DateTimeResource;
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
            "phonePrefix" => $this->phonePrefix,
            "name" => $this->name,
            "email" => $this->email,
            "born" => $this->born,
            "phone" => $this->phone,
            "country" => new CountryResource($this->country),
            "GenderEnum" => new TranslationResource($this->GenderEnum, true),
            "online" => $this->online,
            "StudentStatusEnum" => new TranslationResource($this->StudentStatusEnum, true),
            "block_reason" => $this->block_reason,
            "address" => $this->address,
            "school" => $this->school,
            "image" => $this->image,
            "phone_verified_at" => $this->when($this->phone_verified_at, new DateTimeResource($this->phone_verified_at), null),
            "created_at" => new DateTimeResource($this->created_at),
            "updated_at" => new DateTimeResource($this->updated_at),
            "jwtToken" => $this->jwtToken,
            "jwtTokenExpirationAfter" => auth('student')->factory()->getTTL() * 60 . " seconds",
        ];
    }
}
