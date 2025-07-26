<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role_id == 1) {
            // dd($next($request));
            return $next($request);
        } elseif (Auth::user()->role_id > 1) {
            // $routes = $request->route()->getRoutes();
            $role_id = User::where('id', Auth::user()->id)->first();
            $allowed_routes1 = Role::where('id', $role_id->role_id)->first();
            $allowed_routes = explode(',', $allowed_routes1->privileges);
            // view($allowed_routes);
            $current_route = $request->route()->getName();

            $resource_routes = $allowed_routes;
            $hasAccess = false;

            foreach ($resource_routes as $resource) {
                if (strpos($current_route, $resource) === 0) { // Check if current_route starts with the resource name
                    $hasAccess = true;
                    break;
                }
            }

            // foreach ($allowed_routes as $allowed_route) {
            //     // Check if the current route matches exactly or starts with the allowed route
            //     if ($current_route === $allowed_route || strpos($current_route, $allowed_route . '.') === 0) {
            //         $hasAccess = true;
            //         break;
            //     }
            // }
        
            // Special case: If the user has access to `tele_orders`, allow `get_product_price`
            if (in_array('tele_orders', $allowed_routes) && strpos($current_route, 'get_product_price') !== false) {
                $hasAccess = true;
            }

            if (in_array($current_route, $allowed_routes) || $hasAccess) {
                return $next($request);
            }
            else{
                return abort('403',"You don't have permission to access this page");
            }
        } else {
            abort('403');
        }
    }
}
