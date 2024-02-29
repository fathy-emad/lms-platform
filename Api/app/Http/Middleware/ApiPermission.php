<?php

namespace App\Http\Middleware;

use Closure;
use ApiResponse;
use App\Models\RouteItem;
use App\Models\RouteMenu;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class ApiPermission
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $results = [];
        $requestUri = $request->path();
        $requestAction = explode("@", $action = Route::currentRouteAction())[1];
        $permissions = auth()->user()->permission->permissions ?? [];
        foreach ($permissions as $route){
            $route_data = RouteMenu::find($route["route"]["id"]);
            foreach ($route["route"]["items"] as $item){
                $item_data = RouteItem::find($item["id"]);
                $results[$route_data->route ."/".$item_data->route] = [
                    "actions" => $item["actions"],
                    "allowed" => $item["allowed"]
                ];
            }
        }

        $errors = [];
        //Catch permissions of page
        if (!array_key_exists($requestUri, $results)) $errors[] = "You are not authorized to access this page";

        //Catch permission of action
        if (
            ! isset($results[$requestUri]["actions"][$requestAction]) ||
            ! $results[$requestUri]["actions"][$requestAction]
        ) $errors[] = "You can not do this action {$requestAction} for this page";


        //dd($requestUri, $requestAction);

        if (! empty($errors)) {
            throw new HttpResponseException(ApiResponse::sendError($errors, 'Permission Error', null));
        }


        return $next($request);
    }
}
