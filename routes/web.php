<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

//Route::get("/", function () {
//    return view("dashboard.main");
//});

//
//Route::get("/foo", function () {
//    Artisan::call("storage:link");
//});
//
//Route::post("/upload", function () {
//    if (!is_null(request()->file("file")))
//    {
//        $image = Storage::put("public/item", request()->file("file"));
//        dd($image);
//    }
//});



Route::namespace("Dashboard")
    ->name("dashboard")
    ->prefix("dashboard")
    ->group(function () {
        Route::get("", "MainController@index");

        Route::name(".")->group(function () {
            // Login
            Route::post("login", "LoginController@login")->name("login");

            // Profile
            Route::name("profile.")
                ->prefix("profile")
                ->group(function (){
                    Route::get("{part?}", "ProfileController@index")->name("index");
                    Route::post("update-vendor", "ProfileController@updateVendor")->name("updateVendor");
                    Route::post("update-account", "ProfileController@updateAccount")->name("updateAccount");
                    Route::post("change-password", "ProfileController@changePassword")->name("changePassword");
                    Route::get("logout/from-current-device", "ProfileController@logoutFromCurrentDevice")->name("logoutFromCurrentDevice");
                    Route::get("logout/from-all-devices", "ProfileController@logoutFromAllDevices")->name("logoutFromAllDevices");
                });

            // Vendors
            Route::resource("vendors", "VendorController");

            // Items
            Route::resource("items", "ItemController");














            // Categories
            Route::resource("categories", "CategoryController");

            // Main Show Categories
            Route::resource("main-show-category", "MainShowCategoryController");



            // Classify Items
            Route::resource("classify-items", "ClassifyItemsController");

            // Media
            Route::namespace("Media")->group(function () {
                Route::get("media","MediaController@index")->name("media.index");
                Route::post("media-images/store","MediaController@imageStore")->name("media-images.store");
                Route::put("media-images/select","MediaController@imageSelect")->name("media-images.select");
                Route::delete("media-images/delete","MediaController@imageDelete")->name("media-images.delete");
            });

            // Orders
            Route::resource("orders","OrderController");
        });
    });
