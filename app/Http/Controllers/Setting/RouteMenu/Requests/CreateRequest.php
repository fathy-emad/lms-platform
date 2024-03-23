<?php

namespace App\Http\Controllers\Setting\RouteMenu\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "title" => "required|string|min:2",
            "route" => "required|unique:route_menus,route",
            //"priority" => "nullable|integer",
            "icon" => "nullable|array",
            "icon.file" => "nullable|file|mimes:svg,xml",
            "icon.title" => "nullable|string",
            "ActiveEnum" => "required|in:".implode(",", ActiveEnum::values()),
        ];
    }
}
