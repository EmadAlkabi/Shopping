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
    // Categories
    Route::get('categories', 'CategoryController@index');

    // Top
    Route::get('items/new-product', 'TopController@newProduct');
    Route::get('items/top-sell', 'TopController@topSell');
    Route::get('items/top-rating', 'TopController@topRating');
    Route::get('items/top-discount', 'TopController@topDiscount');
    Route::get('items/top-collection', 'TopController@topCollection');

    // Main Show
    Route::get('main-show/announcements', 'MainShowController@announcements');
    Route::get('main-show/offers', 'MainShowController@offers');

    // Announcements


    // Offers
    Route::get('offers/{offer}', 'OfferController@show')->name('offers.show');

    // Items
    Route::get('items/{item}', 'ItemController@show')->name('items.show');
});
