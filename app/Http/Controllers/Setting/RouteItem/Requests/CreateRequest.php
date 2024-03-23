<?php

namespace App\Http\Controllers\Setting\RouteItem\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use Illuminate\Validation\Rule;

class CreateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "menu_id" => "required|integer|exists:route_menus,id",
            "title" => "required|string|min:2",
            "model" => "required|string",
            "route" => [
                "required",
                Rule::unique("route_items", "route")->where(function ($query){
                    return $query->where("menu_id", $this->menu_id);
                })
            ],
            "actions" => "required|array",
            //"priority" => "nullable|integer",
            "icon" => "nullable|array",
            "icon.file" => "nullable|file|mimes:svg,xml",
            "icon.title" => "nullable|string",
            "ActiveEnum" => "required|in:".implode(",", ActiveEnum::values()),
        ];
    }
}
