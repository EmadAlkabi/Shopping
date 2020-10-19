<?php

namespace App\Http\Middleware\Dashboard;

use App\Enum\Language;
use Closure;

class SetLocale
{

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        //For dashboard
        if (request()->is("dashboard*")) {
            $locale = request()->input("locale");

            if (in_array($locale, Language::getLanguages())) {
                session()->put("dashboard.admin.lang", $locale);
                session()->save();
            }

            if (session()->has("dashboard.admin.lang"))
                app()->setLocale(session()->get("dashboard.admin.lang"));
        }

        return $next($request);
    }
}
