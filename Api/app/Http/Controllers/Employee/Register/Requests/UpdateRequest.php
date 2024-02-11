<?php

namespace App\Http\Controllers\Employee\Register\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use App\Enums\AdminRoleEnum;
use App\Enums\AdminStatusEnum;
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
            "email" => "required|email|unique:admins,email,".$this->id,
            "AdminRoleEnum" => ["required", "string", new Enum(AdminRoleEnum::class)],
            "GenderEnum" => ["required", "string", new Enum(ActiveEnum::class)],
            "AdminStatusEnum" =>["required", "string", new Enum(AdminStatusEnum::class)],
            "blocked_reason" => "required_if:AdminStatusEnum," . AdminStatusEnum::Blocked->value,
            "national_id" => "required|digits:14|unique:admins,national_id,".$this->id,
            "flag" => "nullable|array",
            "flag.key" => [
                "nullable",
                "integer",
                Rule::exists("languages", "flag->key")->where(function ($query){
                    return $query->where("id", $this->id);
                })
            ],
            "flag.file" => "nullable|image",
            "flag.title" => "nullable|string",
            "country_id" => "required|exists:countries,id",
        ];
    }
}
