<?php

namespace App\Http\Controllers\Setting\FAQ\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "question" => "required|string|min:4",
            "answer" => "required|string|min:4",
            "ActiveEnum" => "sometimes|in:".implode(",", ActiveEnum::values()),
        ];
    }
}
