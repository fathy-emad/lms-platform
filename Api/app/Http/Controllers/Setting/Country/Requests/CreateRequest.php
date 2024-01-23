<?php

namespace App\Http\Controllers\Setting\Country\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "symbol" => "required|string|unique:countries",
            "country" => "required|string|min:2",
            "phone_prefix" => "required|string",
            "timezone" => "required|string",
            "currency" => "required|string|min:2",
            "currency_symbol" => "required|string",
            "flag" => "required|file|mimes:svg,xml",
            "ActiveEnum" => "required|in:".implode(",", ActiveEnum::values()),
        ];
    }
}
