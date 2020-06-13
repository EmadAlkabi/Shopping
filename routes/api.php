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

Route::namespace('Api')->group(function () {
    // Service
    Route::post('service', 'ServiceController@index');
//    Route::get('service', 'ServiceController@index');

    // Categories
    Route::get('categories/tree', 'CategoryController@tree');
    Route::get('categories', 'CategoryController@index');

    // Top
    Route::get('items/new-product', 'TopController@newProduct');
    Route::get('items/top-sell', 'TopController@topSell');
    Route::get('items/top-rating', 'TopController@topRating');
    Route::get('items/top-discount', 'TopController@topDiscount');
    Route::get('items/top-collection', 'TopController@topCollection');
    Route::get('items/best-top-collection', 'TopController@bestTopCollection');

    // Main Show
    Route::get('main-show/announcements', 'MainShowController@announcements');
    Route::get('main-show/offers', 'MainShowController@offers');

    // Offers
    Route::get('offers/{offer}', 'OfferController@show')->name('offers.show');

    // Items
    Route::get('items/{item}', 'ItemController@show')->name('items.show');

    // Search
    Route::get('search', 'SearchController@search');

    // User
    Route::post('users/store', 'UserController@store');
    Route::post('users/update', 'UserController@update');
    Route::get('users/get-by-phone/{phone}', 'UserController@getByPhone');

    // Reviews
    Route::get('reviews/all', 'ReviewController@allReviews');
    Route::get('reviews/single', 'ReviewController@singleReview');
    Route::post('reviews/store', 'ReviewController@store');
    Route::post('reviews/delete', 'ReviewController@delete');

    // Order Item (cart)
    Route::get('order-items', 'OrderItemController@index');
    Route::post('order-items/store', 'OrderItemController@store');
    Route::post('order-items/delete', 'OrderItemController@delete');

    // Order
    Route::get('orders', 'OrderController@index');
    Route::post('orders/store', 'OrderController@store');
});
