<?php

namespace App\Http\Controllers\AuthStudent\Resources;

use App\Http\Controllers\Employee\Permission\PermissionResource;
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
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "national_id" => $this->national_id,
            "country" => $this->country ?? null,
            "AdminRoleEnum" => new TranslationResource($this->AdminRoleEnum, true),
            "AdminStatusEnum" => new TranslationResource($this->AdminStatusEnum, true),
            "GenderEnum" => new TranslationResource($this->GenderEnum, true),
            "block_reason" => $this->block_reason,
            "online" => $this->online,
            "image" => $this->image,
            "address" => $this->address,
            "email_verified_at" => $this->email_verified_at,
            "created_by" => new AuthorResource($this->createdBy),
            "updated_by" => $this->updated_by ? new AuthorResource($this->updatedBy) : null,
            "created_at" => new DateTimeResource($this->created_at),
            "updated_at" => new DateTimeResource($this->updated_at),
            "jwtToken" => $this->jwtToken,
            "jwtTokenExpirationAfter" => auth('admin')->factory()->getTTL() * 60 . " seconds",
            "permission" => $this->permission ? new PermissionResource($this->permission) : null,
        ];
    }
}
