<?php

namespace App\Http\Middleware\Dashboard;

use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\LogoutController;
use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //For dashboard
        if (request()->is("dashboard*")) {
            if (!Cookie::has("Dashboard"))
                abort(302, "", ["Location" => route("dashboard")]);

            if (!session()->has("dashboard.admin.token")) {
                $admin = Admin::where("token", Cookie::get("Dashboard"))->first();

                if ($admin)
                    LoginController::generateSession($admin);
                else {
                    LogoutController::removeCookie();
                    abort(302, "", ["Location" => route("dashboard")]);
                }
            }
        }

        return $next($request);
    }
}
