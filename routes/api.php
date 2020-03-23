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

    // Top Items
    Route::get('items/new-product', 'ItemController@newProduct');
    Route::get('items/top-sell', 'ItemController@topSell');
    Route::get('items/top-rating', 'ItemController@topRating');
    Route::get('items/top-discount', 'ItemController@topDiscount');

    // Main Show
    Route::get('announcements/main/{numberOfAnnouncements?}', 'AnnouncementController@mainAnnouncements');
    Route::get('offers/main/{numberOfOffers?}', 'OfferController@mainOffers');

    // Single Item
    Route::get('items/{id}', 'ItemController@singleItem');
});
