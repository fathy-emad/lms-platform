<?php

namespace App\Http\Controllers\Setting\RouteMenu\Requests;

use App\Concretes\ValidateRequest;
use App\Enums\ActiveEnum;
use Illuminate\Validation\Rule;

class UpdateRequest extends ValidateRequest
{
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:route_menus",
            "title" => "required|array|min:1",
            "title.ar" => "required|string|regex:/^[\x{0600}-\x{06FF}\s]+$/u",
            "title.*" => "nullable|string",
            "route" => "required|unique:route_menus,route," . $this->id,
            //"priority" => "nullable|integer",
            "icon.key" => [
                "nullable",
                "integer",
                Rule::exists("route_menus", "icon->key")->where(function ($query){
                    return $query->where("id", $this->id);
                })
            ],
            "icon.file" => "nullable|file|mimes:svg,xml",
            "icon.title" => "nullable|string",
            "ActiveEnum" => "sometimes |in:".implode(",", ActiveEnum::values()),
        ];
    }
}
