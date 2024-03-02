<?php

namespace App\Http\Controllers\Employee\Permission\Requests;

use App\Concretes\ValidateRequest;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "admin_id" => "required|integer|exists:admins,id|unique:permissions,admin_id," . $this->id,
            "permissions" => "required|array",
            "permissions.*.route.id" => "required|integer|exists:route_menus,id",
            "permissions.*.route.items.*.id" => "required|integer|exists:route_items,id",
            "permissions.*.route.items.*.actions.*" => "required|integer|in:0,1,2",
        ];
    }
}
