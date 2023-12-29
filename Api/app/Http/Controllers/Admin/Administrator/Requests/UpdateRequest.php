<?php

namespace App\Http\Controllers\Admin\Administrator\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\AdminRoleEnum;
use App\Enums\AdminStatusEnum;
use App\Enums\GenderEnum;
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
            "AdminRoleEnum" => "required|in:".implode(",", AdminRoleEnum::values()),
            "GenderEnum" => "required|in:".implode(",", GenderEnum::values()),
            "AdminStatusEnum" => "required|in:".implode(",", AdminStatusEnum::values()),
            "blocked_reason" => "required_if:AdminStatusEnum," . AdminStatusEnum::Blocked->value,
            "national_id" => "required|digits:14|unique:admins,national_id,".$this->id,
            "image" => "nullable|image",
            "country_id" => "required|exists:countries,id",
            "password" => ["nullable", "confirmed", Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            "password_confirmation" => "required_with:password",
        ];
    }
}
