<?php

namespace App\Http\Controllers\Employee\Register\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use App\Enums\AdminRoleEnum;
use App\Enums\AdminStatusEnum;
use App\Enums\GenderEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:admins",
            "name" => "required|string|regex:/^[a-zA-Z0-9 .,?!\'’\"-]+$/u",
            "phone" => "required|digits:10|unique:admins,phone,".$this->id,
            "email" => "sometimes|email|unique:admins,email,".$this->id,
            "AdminRoleEnum" => ["sometimes", "string", new Enum(AdminRoleEnum::class)],
            "GenderEnum" => ["required", "string", new Enum(GenderEnum::class)],
            "AdminStatusEnum" =>["sometimes", "string", new Enum(AdminStatusEnum::class)],
            "block_reason" => "required_if:AdminStatusEnum," . AdminStatusEnum::Blocked->value,
            "national_id" => "sometimes|digits:14|unique:admins,national_id,".$this->id,
            "image.key" => [
                "nullable",
                "integer",
                Rule::exists("admins", "image->key")->where(function ($query){
                    return $query->where("id", $this->id);
                })
            ],
            "image.file" => "nullable|image",
            "image.title" => "nullable|string",
            "country_id" => "required|exists:countries,id",
        ];
    }
}
