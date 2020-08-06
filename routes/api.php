<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace("Api")->group(function () {
    // Service
    Route::post("service", "ServiceController@index");

    // Categories
    Route::get("categories", "CategoryController@index");
    Route::get("categories/tree", "CategoryController@tree");

    // Items
    Route::get("items", "ItemController@index");
    Route::get("items/{item}/show", "ItemController@show")->name("items.show");
    Route::get("items/new-product", "ItemController@newProduct");
    Route::get("items/top-sell", "ItemController@topSell");
    Route::get("items/top-rating", "ItemController@topRating");
    Route::get("items/top-discount", "ItemController@topDiscount");
    Route::get("items/top-collection", "ItemController@topCollection");
    Route::get("items/best-top-collection", "ItemController@bestTopCollection");





    // User
    Route::post("users/store", "UserController@store");
    Route::post("users/update", "UserController@update");
    Route::get("users/get-by-phone/{phone}", "UserController@getByPhone");

    // Reviews
    Route::get("reviews/all", "ReviewController@all");
    Route::get("reviews/single", "ReviewController@single");
    Route::post("reviews/store", "ReviewController@createOrUpdate");
    Route::post("reviews/delete", "ReviewController@delete");





    // Order Item (cart)
    Route::get("order-items/my-cart", "OrderItemController@myCart");
    Route::post("order-items/create-or-update", "OrderItemController@createOrUpdate");
    Route::get("order-items/{orderItem}/delete", "OrderItemController@delete");







    // Main Show
    Route::get("main-show/announcements", "MainShowController@announcements");
    Route::get("main-show/offers", "MainShowController@offers");

    // Offers
    Route::get("offers/{offer}", "OfferController@show")->name("offers.show");





    // Order
    Route::get("orders", "OrderController@index");
    Route::post("orders/store", "OrderController@store");












});
