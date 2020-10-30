<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware("dashboard.auth");
        $this->middleware("getCurrentVendor")->only(["index"]);
        $this->middleware("getCurrentAdmin")->only(["index", "logoutFromAllDevices"]);
    }

    /**
     * Display profile for the admin.
     *
     * @param Request $request
     * @param null $part
     * @return Application|Factory|View
     */
    public function index(Request $request, $part = null)
    {
        return view("dashboard.profile.index")->with([
            "admin"  => $request->admin,
            "vendor" => $request->vendor
        ]);
    }

    /**
     * Logout from current device.
     *
     * @return RedirectResponse
     */
    public function logoutFromCurrentDevice()
    {
        self::removeCookie();
        self::removeSession();

        return redirect()->route("dashboard");
    }

    /**
     * Logout from all devices.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function logoutFromAllDevices(Request $request)
    {
        self::removeTokenFromAdmin($request->admin);
        self::removeCookie();
        self::removeSession();

        return redirect()->route("dashboard");
    }

    /**
     * Remove cookie.
     */
    public static function removeCookie()
    {
        Cookie::queue(cookie()->forget("Dashboard"));
    }

    /**
     * Remove session.
     */
    public static function removeSession()
    {
        session()->forget("dashboard");
    }

    /**
     * Remove token.
     *
     * @param Admin $admin
     */
    public static function removeTokenFromAdmin(Admin $admin)
    {
        $admin->token = null;
        $admin->save();
    }
}
