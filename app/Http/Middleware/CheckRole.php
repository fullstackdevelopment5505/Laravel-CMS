<?php

namespace App\Http\Middleware;

use Closure;
use App\Addon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $route = $request->route()->uri;
        if (! $request->user()->hasRole($role)) {
            abort(401, 'This action is unauthorized.');
        }       
        if(Str::contains($route, 'addon')) {
            $addon = Addon::where('admin_route_param',$route)->where("status", '1')->first();
            if(!isset($addon)){
                abort(404, 'This action is unauthorized.');
            }
        }
        return $next($request);
    }
}
