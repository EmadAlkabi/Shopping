<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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

        $this->middleware("dashboard.auth");

        return view("dashboard.main");
    }
}
