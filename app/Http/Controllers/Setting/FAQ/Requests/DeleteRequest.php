<?php

namespace App\Http\Controllers\Setting\FAQ\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;

class DeleteRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:faqs,id",
        ];
    }
}
