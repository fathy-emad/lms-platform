<?php

namespace App\Http\Controllers\Admin\Country\Requests;

use App\Concretes\ValidateRequest;

class DeleteRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:admins",
        ];
    }
}
