<?php

namespace App\Http\Middleware\Dashboard;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        //For dashboard
        if (request()->is("dashboard*")) {
            $roles = session()->get("dashboard.admin.roles");
            if (!in_array($role, $roles))
                abort(403, __("dashboard/middleware.auth"));
        }

        return $next($request);
    }
}
