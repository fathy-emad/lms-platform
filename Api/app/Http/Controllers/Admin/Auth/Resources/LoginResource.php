<?php

namespace App\Http\Controllers\Admin\Auth\Resources;

use App\Enums\AdminStatusEnum;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\DateTimeResource;
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
            "jwtToken" => $this->jwtToken,
            "jwtTokenExpirationAfter" => auth('admin')->factory()->getTTL() * 60 . " seconds",
            "created_by" => new AuthorResource($this->createdBy),
            "updated_by" => $this->updated_by ? new AuthorResource($this->updatedBy) : null,
            "created_at" => new DateTimeResource($this->created_at),
            "updated_at" => new DateTimeResource($this->updated_at),
        ];
    }
}
