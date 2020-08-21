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
    ->prefix("dashboard")
    ->name("dashboard.")
    ->group(function () {
        // Categories
        Route::resource("categories", "CategoryController");

        // Category Items
        Route::get("category-item","CategoryItemController@index");


        // Items
        Route::namespace("Item")->group(function () {
            // Resource
            Route::resource("items", "ItemController");
            Route::post("items/change-deleted","ItemController@changeDeleted");
            // Api
            Route::post("api/items/change-deleted","ApiItemController@changeDeleted");
        });

        // Media
        Route::namespace("Media")->group(function () {
            Route::get("media","MediaController@index")->name("media.index");
            Route::post("media-images/store","MediaController@imageStore")->name("media-images.store");
            Route::put("media-images/select","MediaController@imageSelect")->name("media-images.select");
            Route::delete("media-images/delete","MediaController@imageDelete")->name("media-images.delete");
        });


    });
