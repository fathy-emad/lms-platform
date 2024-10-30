<?php

namespace App\Http\Controllers\Setting\CancellationRefundPolicy\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "header" => "required|string|min:4",
            "body" => "required|string|min:4",
            "ActiveEnum" => "sometimes|in:".implode(",", ActiveEnum::values()),
        ];
    }
}
