<?php

namespace App\Http\Controllers\Setting\Enumeration\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\SystemConstantsEnum;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:enumerations",
            "key" => "required|in:".implode(",", SystemConstantsEnum::values()),
            "value.ar" => "required|string|regex:/^[\x{0600}-\x{06FF}\s]+$/u",
            "value.*" => "nullable|string",
        ];
    }
}
