<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName = Route::currentRouteName();
        // $role = Auth::user()->id_role;
        $role = 1; //example
        // get permission data from table permissions
        $permission = Permission::with(['role', 'menu'])->whereRelation('menu', 'route_name', '=', $routeName)->whereRelation('role', 'id', '=', $role)->first();
        // if data not found, then redirect to home page
        if (!$permission && $routeName != 'home') {
            return redirect(route('home')); //change with home url
        }
        return $next($request);
    }
}
