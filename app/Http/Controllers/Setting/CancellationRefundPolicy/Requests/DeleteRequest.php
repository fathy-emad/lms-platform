<?php

namespace App\Http\Controllers\Setting\CancellationRefundPolicy\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;

class DeleteRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:cancellation_refund_policies,id",
        ];
    }
}
