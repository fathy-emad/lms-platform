<?php

namespace App\Http\Controllers\Employee\Permission\Requests;

use App\Concretes\ValidateRequest;

class UpdateRequest extends ValidateRequest
{

    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:permissions,id",
            "admin_id" => "required|integer|exists:admins,id|unique:permissions,admin_id," . $this->id,
            "permissions" => "required|array",
            "permissions.*.id" => "required|integer|exists:route_menus,id",
            "permissions.*.items.*.id" => "required|integer|exists:route_items,id",
            "permissions.*.items.*.specific_actions_belongs_to" => "nullable|string",
            "permissions.*.items.*.actions.*" => "required|integer|in:0,1,2",
        ];
    }
}
