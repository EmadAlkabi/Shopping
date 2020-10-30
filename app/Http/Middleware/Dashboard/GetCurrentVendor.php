<?php

namespace App\Http\Middleware\Dashboard;

use App\Models\Vendor;
use Closure;
use Illuminate\Http\Request;

class GetCurrentVendor
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
        return app(GetCurrentAdmin::class)->handle($request, function ($request) use ($next) {
            $vendor = Vendor::find($request->admin->vendor_id);
            $request->request->add(["vendor" => $vendor]);

            return $next($request);
        });
    }
}
