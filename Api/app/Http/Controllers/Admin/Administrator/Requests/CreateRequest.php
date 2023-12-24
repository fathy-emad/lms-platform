<?php

namespace App\Http\Controllers\Admin\Administrator\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\AdminRoleEnum;
use App\Enums\AdminStatusEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "name" => "required|string|min:4|regex:/^[a-zA-Z]+\\s[a-zA-Z]+\\s[a-zA-Z]+$/",
            "prefix" => "required|string",
            "phone" => "required|integer|digits:10|unique:admins",
            "email" => "required|email|unique:admins",
            "password" => ["required", "confirmed", Password::min(8)->mixedCase()->numbers()->symbols()],
            "password_confirmation" => "required",
            "roleEnum" => ["required", "string", Rule::in(AdminRoleEnum::cases())],
            "statusEnum" => ["required", "string", Rule::in(AdminStatusEnum::cases())],
            "national_id" => "required|integer|digits:14",
            "image" => "nullable|image",
            "address" => "nullable|array",
//            "country_id" => "",
//            "permission_id" => "",
        ];
    }
}
