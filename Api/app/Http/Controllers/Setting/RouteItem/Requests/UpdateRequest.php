<?php

namespace App\Http\Controllers\Setting\RouteItem\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use Illuminate\Validation\Rule;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:route_items",
            "menu_id" => "required|integer|exists:route_menus,id",
            "title" => "required|array|min:1",
            "title.ar" => "required|string|regex:/^[\x{0600}-\x{06FF}\s]+$/u",
            "title.*" => "nullable|string",
            "route" => [
                "required",
                Rule::unique("route_items", "route")->where(function ($query){
                    return $query->where("menu_id", $this->menu_id);
                })->ignore($this->id)
            ],
            "methods" => "required|array",
            //"priority" => "nullable|integer",
            "icon" => "nullable|array",
            "icon.key" => [
                "nullable",
                "integer",
                Rule::exists("route_items", "icon->key")->where(function ($query){
                    return $query->where("id", $this->id);
                })
            ],
            "icon.file" => "nullable|file|mimes:svg,xml",
            "icon.title" => "nullable|string",
            "ActiveEnum" => "required|in:".implode(",", ActiveEnum::values()),
        ];
    }
}
