<?php

namespace App\Http\Controllers\Admin\Settings\Enumeration\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;

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
