<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;

class MainController extends Controller
{
    /**
     * Show the admin page or go to the login page.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if (!Cookie::has("Dashboard"))
            return view("dashboard.login");

        if (!session()->has("dashboard.token")) {
            $admin = Admin::where("token", Cookie::get("Dashboard"))->first();

            if ($admin)
                LoginController::generateSession($admin);
            else {
                ProfileController::removeCookie();
                return view("dashboard.login");
            }
        }

        return view("dashboard.main");
    }
}
