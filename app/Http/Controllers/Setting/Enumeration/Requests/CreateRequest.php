<?php

namespace App\Http\Controllers\Setting\Enumeration\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\SystemConstantsEnum;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "key" => "required|in:".implode(",", SystemConstantsEnum::values()),
            "value" => "required|string|min:2",
        ];
    }
}
