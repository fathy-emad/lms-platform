<?php

namespace App\Http\Controllers\Setting\RouteItem\Requests;

use App\Concretes\ValidateRequest;

class ReorderRequest extends ValidateRequest
{

    public function rules(): array
    {
        return [
            "reorder.*.id" => "required|integer|exists:route_items,id",
            "reorder.*.priority" => "required|integer"
        ];
    }
}
