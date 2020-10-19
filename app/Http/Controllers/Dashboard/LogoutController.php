<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;

class LogoutController extends Controller
{
    /**
     * Logout
     *
     * @return RedirectResponse
     */
    public function logout()
    {
        self::removeCookie();

        return redirect()->route("dashboard.login");
    }
    /**
     * Remove cookie for the admin.
     */
    public static function removeCookie()
    {
        Cookie::queue(cookie()->forget("Dashboard"));
    }
}
