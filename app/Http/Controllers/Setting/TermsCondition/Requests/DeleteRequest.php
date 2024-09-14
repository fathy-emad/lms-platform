<?php

namespace App\Http\Controllers\Setting\TermsCondition\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;

class DeleteRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:terms_conditions,id",
        ];
    }
}
