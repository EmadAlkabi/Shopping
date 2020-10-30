<?php

namespace App\Http\Middleware\Dashboard;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;

class GetCurrentAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $admin = Admin::where("token", session("dashboard.token"))->first();
        $request->request->add(["admin" => $admin]);

        return $next($request);
    }
}
