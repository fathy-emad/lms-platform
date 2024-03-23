<?php

namespace App\Http\Controllers\Setting\Language\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "locale" => "required|string|unique:languages,locale",
            "language" => "required|string|min:2",
            "flag" => "required|array|size:2",
            "flag.file" => "required|file|mimes:svg,xml",
            "flag.title" => "nullable|string",
            "ActiveEnum" => "required|in:".implode(",", ActiveEnum::values()),
        ];
    }
}
