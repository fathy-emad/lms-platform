<?php

namespace App\Http\Controllers\Setting\ReturnRefundPolicy\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:return_refund_policies,id",
            "header" => "required|array",
            "header.ar" => "required|string",
            "header.*" => "nullable|string",
            "body" => "required|array",
            "body.ar" => "required|string",
            "body.*" => "nullable|string",
            "ActiveEnum" => "sometimes|in:".implode(",", ActiveEnum::values()),
        ];
    }
}
