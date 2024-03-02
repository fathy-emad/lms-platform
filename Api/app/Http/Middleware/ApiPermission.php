<?php

namespace App\Http\Middleware;

use Closure;
use ApiResponse;
use App\Models\RouteItem;
use App\Models\RouteMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

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

        if (auth()->user()->id != 1){
            $results = [];
            $requestUri = $request->path();
            $requestAction = explode("@", Route::currentRouteAction())[1];
            $permissions = auth()->user()->permission->permissions ?? [];
            foreach ($permissions as $route){
                $route_data = RouteMenu::find($route["route"]["id"]);
                foreach ($route["route"]["items"] as $item){
                    $item_data = RouteItem::find($item["id"]);
                    $results[$route_data->route ."/".$item_data->route] = [
                        "model" => $item_data->model,
                        "actions" => $item["actions"],
                    ];
                }
            }

            $errors = [];
            //Catch permissions of page
            if (!array_key_exists($requestUri, $results))
                $errors[] = "You are not authorized to access this page";

            //Catch permission of action
            else if (! array_key_exists($requestAction, $results[$requestUri]["actions"]) || ! $results[$requestUri]["actions"][$requestAction])
                $errors[] = "You can not do this action {$requestAction} for this page";

            //Catch not auth of model for (update or delete)
            else if ($results[$requestUri]["actions"][$requestAction] == 2)
            {
                $modelName =  "App\\Models\\" . $results[$requestUri]["model"];
                $model = $modelName::find($request->id);
                if (isset($model) && $model->created_by !== auth()->user()->id){
                    $errors[] = "You can not do this action {$requestAction} because you are not the author of record";
                }
            }


            if (! empty($errors)) throw new HttpResponseException(ApiResponse::sendError($errors, 'Permission Error', null));
        }

        return $next($request);
    }
}
