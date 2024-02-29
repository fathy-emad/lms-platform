<?php

namespace App\Http\Controllers\Employee\Permission\Requests;

use App\Concretes\ValidateRequest;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "admin_id" => "required|integer|exists:admins,id|unique:permissions,admin_id",
            "permissions" => "required|array",
            "permissions.*.route.id" => "required|integer|exists:route_menus,id",
            "permissions.*.route.items.*.id" => "required|integer|exists:route_items,id",
            "permissions.*.route.items.*.actions.*" => "required|boolean",
            "permissions.*.route.items.*.allowed.read_all" => "required|boolean",
            "permissions.*.route.items.*.allowed.update_all" => "required|boolean",
            "permissions.*.route.items.*.allowed.delete_all" => "required|boolean",
        ];
    }
}
