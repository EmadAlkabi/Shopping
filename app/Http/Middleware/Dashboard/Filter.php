<?php

namespace App\Http\Middleware\Dashboard;

use App\Enum\AnnouncementType;
use App\Enum\DocumentType;
use App\Enum\LecturerState;
use App\Enum\UserState;
use App\Enum\UserType;
use App\Models\Category;
use Closure;

class Filter
{
    /**
     * Handle an incoming request.
     * @param $request
     * @param Closure $next
     * @param $parameter
     * @return mixed
     */
    public function handle($request, Closure $next, $parameter)
    {
        //For admin
        if (request()->is("dashboard*")) {
            switch ($parameter) {
                // Item
                case "item-f":
                    if (!is_null(request()->input("f")) && !in_array(request()->input("f"), array("all", "deleted")))
                        abort(403, __("dashboard/middleware.filter.item.filter"));
                    break;
                case "item-c":
                    if (!is_null(request()->input("c")) && !in_array(request()->input("c"), Category::all()->pluck("id")->toArray()))
                        abort(403, __("dashboard/middleware.filter.item.category"));
                    break;
            }
        }

        return $next($request);
    }
}
