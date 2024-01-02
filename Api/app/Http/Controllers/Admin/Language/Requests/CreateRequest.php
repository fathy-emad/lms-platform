<?php

namespace App\Http\Controllers\Admin\Language\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "locale" => "required|string|unique:languages",
            "language" => "required|array|min:2",
            "language.*" => "nullable|string",
            "language.ar" => "required|string|regex:/^[\x{0600}-\x{06FF}\s]+$/u",
            "language.en" => "required|string|regex:/^[a-zA-Z0-9 .,?!\'’\"-]+$/u",
            "country_id" => "nullable|exist:countries,id",
            "ActiveEnum" => "required|in:".implode(",", ActiveEnum::values()),
        ];
    }
}
