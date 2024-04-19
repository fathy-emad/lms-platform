<?php

namespace App\Http\Controllers\Employee\Permission;

use App\Http\Resources\AuthorResource;
use App\Http\Resources\DateTimeResource;
use App\Http\Resources\TranslationResource;
use App\Models\RouteItem;
use App\Models\RouteMenu;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $permissions = $this->permissions;
        foreach ($permissions as &$route){
            $route_data = RouteMenu::find($route["id"]);
            $route["title"] = new TranslationResource($route_data->titleTranslate);
            $route["icon"] = $route_data->icon;
            foreach ($route["items"] as &$item){
                $item_data = RouteItem::find($item["id"]);
                $item["title"] = new TranslationResource($item_data->titleTranslate);
                $item["link"] = $route_data->route ."/".$item_data->route;
                $item["icon"] = $item_data->icon;
                foreach ($item["actions"] as &$value) $value = (int) $value;
                unset($value);
            }
            unset($item);
        }
        unset($route);

        return [
            "id" => $this->id,
            "admin_id" => $this->admin_id,
            "admin" => $this->admin,
            "permissions" => $permissions,
            "created_by" => new AuthorResource($this->createdBy),
            "updated_by" => $this->updated_by ? new AuthorResource($this->updatedBy) : null,
            "created_at" => new DateTimeResource($this->created_at),
            "updated_at" => new DateTimeResource($this->updated_at),
        ];
    }
}
