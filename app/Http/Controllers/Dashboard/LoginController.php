<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LoginRequest;
use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    /**
     * Login the admin.
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $admin = Admin::where(["username" => $request->input("username"), "password" => md5($request->input("password"))])
            ->first();

        if (!$admin)
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(["login-failed" => __("dashboard/login.failed-message")]);

        self::generateSession($admin);
        self::generateCookie($admin);
        return redirect()->route("dashboard");
    }

    /**
     * Generate session for the admin.
     *
     * @param Admin $admin
     */
    public static function generateSession(Admin $admin) {
        $vendor = Vendor::find($admin->vendor_id);
        session()->put("dashboard.lang", app()->getLocale());
        session()->put("dashboard.vendor", $vendor->name);
        session()->put("dashboard.token", $admin->token);
        session()->put("dashboard.roles", $admin->roles->pluck("name")->toArray());
        session()->save();
        self::updateLoginDate($admin);
    }

    /**
     * Update login date for the admin.
     *
     * @param Admin $admin
     */
    public static function updateLoginDate(Admin $admin)
    {
        if (is_null($admin->token))
            $admin->token = hash_hmac("sha256",md5(microtime(true).mt_Rand()),bcrypt($admin->username));
        $admin->last_login = date("Y-m-d H:i:s");
        $admin->save();
    }

    /**
     * Generate cookie for the admin.
     *
     * @param Admin $admin
     */
    public static function generateCookie(Admin $admin) {
        Cookie::queue(cookie()->forever("Dashboard", $admin->token));
    }
}
