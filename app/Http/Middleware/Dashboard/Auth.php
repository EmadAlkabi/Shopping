<?php

namespace App\Http\Middleware\Dashboard;

use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //For dashboard
        if (request()->is("dashboard*")) {
            if (!Cookie::has("Dashboard"))
                abort(302, "", ["Location" => route("dashboard")]);

            if (!session()->has("dashboard.token")) {
                $admin = Admin::where("token", Cookie::get("Dashboard"))->first();

                if ($admin)
                    LoginController::generateSession($admin);
                else {
                    ProfileController::removeCookie();
                    abort(302, "", ["Location" => route("dashboard")]);
                }
            }
        }

        return $next($request);
    }
}
