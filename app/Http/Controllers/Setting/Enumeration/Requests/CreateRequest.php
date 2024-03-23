<?php

namespace App\Http\Controllers\Setting\Enumeration\Requests;

use App\Concretes\ValidateRequest;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "key" => "required|string",
            "value" => "required|string|min:2",
        ];
    }
}
