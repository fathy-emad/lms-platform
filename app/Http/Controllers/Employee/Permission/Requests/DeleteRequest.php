<?php

namespace App\Http\Controllers\Employee\Permission\Requests;

use App\Concretes\ValidateRequest;

class DeleteRequest  extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:permissions,id",
        ];
    }
}
