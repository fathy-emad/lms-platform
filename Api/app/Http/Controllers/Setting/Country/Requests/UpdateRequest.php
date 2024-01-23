<?php

namespace App\Http\Controllers\Setting\Country\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:countries",
            "symbol" => "required|string|unique:countries,symbol,".$this->id,
            "country" => "required|array|min:1",
            "country.ar" => "required|string|regex:/^[\x{0600}-\x{06FF}\s]+$/u",
            "country.*" => "nullable|string",
            "phone_prefix" => "required|string",
            "timezone" => "required|string",
            "currency" => "required|array|min:1",
            "currency.ar" => "required|string|regex:/^[\x{0600}-\x{06FF}\s]+$/u",
            "currency.*" => "nullable|string",
            "currency_symbol" => "required|string",
            "flag" => "nullable|file|mimes:svg,xml",
            "ActiveEnum" => "required|in:".implode(",", ActiveEnum::values()),
        ];
    }
}
