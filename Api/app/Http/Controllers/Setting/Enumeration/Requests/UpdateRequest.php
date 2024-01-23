<?php

namespace App\Http\Controllers\Setting\Enumeration\Requests;

use App\Concretes\ValidateRequest;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:enumerations",
            "value" => "required|array|min:1",
            "value.ar" => "required|string|regex:/^[\x{0600}-\x{06FF}\s]+$/u",
            "value.*" => "nullable|string",
        ];
    }
}
