<?php

namespace App\Http\Controllers\Admin\Country\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "symbol" => "required|string|unique:countries",
            "country" => "required|array|min:2",
            "country.*" => "nullable|string",
            "country.ar" => "required|string|regex:/^[\x{0600}-\x{06FF}\s]+$/u",
            "country.en" => "required|string|regex:/^[a-zA-Z0-9 .,?!\'’\"-]+$/u",
            "phone_prefix" => "required|string",
            "timezone" => "required|string",
            "currency" => "required|array|min:2",
            "currency.*" => "nullable|string",
            "currency.ar" => "required|string|regex:/^[\x{0600}-\x{06FF}\s]+$/u",
            "currency.en" => "required|string|regex:/^[a-zA-Z0-9 .,?!\'’\"-]+$/u",
            "currency_symbol" => "required|string",
            "flag" => "nullable|file|mimes:svg,xml",
            "ActiveEnum" => "required|in:".implode(",", ActiveEnum::values()),
        ];
    }
}
