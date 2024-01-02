<?php

namespace App\Http\Controllers\Admin\Auth\Resources;

use App\Enums\AdminStatusEnum;
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
            "national_id" => $this->national_id,
            "country_id" => $this->country->countryTranslate->translates[app()->getLocale()] ?? null,
            "AdminRoleEnum" => [
                'key' => $this->AdminRoleEnum->value,
                'translation' => $this->AdminRoleEnum->title()
            ],
            "AdminStatusEnum" => [
                'key' => $this->AdminStatusEnum->value,
                'translation' => $this->AdminStatusEnum->title()
            ],
            "GenderEnum" => [
                'key' => $this->GenderEnum->value,
                'translation' => $this->GenderEnum->title()
            ],
            "block_reason" => $this->block_reason,
            "online" => $this->online,
            "image" => $this->image,
            "address" => $this->address,
            "email_verified_at" => $this->email_verified_at,
            "created_by" => $this->createdBy->name ?? null,
            "created_at" => $this->created_at,
            "updated_by" => $this->updatedBy->name ?? null,
            "updated_at" => $this->updated_at,
            "jwtToken" => $this->jwtToken,
            "jwtTokenExpirationAfter" => auth('admin')->factory()->getTTL() * 60 . " seconds",
        ];
    }
}
