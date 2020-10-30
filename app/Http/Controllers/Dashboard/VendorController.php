<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateVendorRequest;
use App\Models\Admin;
use App\Models\AdminRole;
use App\Models\Role;
use App\Models\Vendor;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class VendorController extends Controller
{
    /**
     * VendorController constructor.
     */
    public function __construct()
    {
        $this->middleware("dashboard.auth");
        $this->middleware("dashboard.role:Vendor");
//        $this->middleware("filter:item-f")->only(["index"]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view("dashboard.vendor.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateVendorRequest $request
     * @return RedirectResponse
     */
    public function store(CreateVendorRequest $request)
    {
        $exception = DB::transaction(function () use ($request){
            $vendor = Vendor::create([
                "name"   => $request->input("vendorName"),
                "email"  => $request->input("vendorEmail"),
                "phone"  => $request->input("vendorPhone"),
                "gps"    => $request->input("vendorGPS"),
                "detail" => $request->input("vendorDetail"),
                "state"  => $request->input("vendorState")
            ]);

            $admin = Admin::create([
                "vendor_id" => $vendor->id,
                "name"      => $request->input("adminName"),
                "username"  => $request->input("adminUsername"),
                "password"  => md5($request->input("adminPassword")),
                "state"     => $request->input("adminState")
            ]);

            $roles = Role::where("name","!=", "Vendor")->get();
            foreach ($roles as $role) {
                AdminRole::create([
                    "admin_id" => $admin->id,
                    "role_id"  => $role->id
                ]);
            }
        });

        if ($exception)
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    "message" => __("dashboard/vendor.store.failed"),
                    "type"    => "success"
                ]);

        return redirect()
            ->back()
            ->with([
                "message" => __("dashboard/vendor.store.success"),
                "type"    => "success"
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return Response
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Vendor  $vendor
     * @return Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}
