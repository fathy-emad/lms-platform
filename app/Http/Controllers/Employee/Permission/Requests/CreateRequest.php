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
            "permissions.*.id" => "required|integer|exists:route_menus,id",
            "permissions.*.items.*.id" => "required|integer|exists:route_items,id",
            "permissions.*.items.*.specific_actions_belongs_to" => "nullable|string",
            "permissions.*.items.*.actions.*" => "required|integer|in:0,1,2",
        ];
    }
}
