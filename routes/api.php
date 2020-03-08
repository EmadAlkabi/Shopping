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
    // Items
    Route::get('items', 'ItemController@index');
    Route::get('items/new-product', 'ItemController@newProduct');
    Route::get('items/top-sell', 'ItemController@topSell');
    Route::get('items/top-rating', 'ItemController@topRating');
    Route::get('items/top-discount', 'ItemController@topDiscount');

    // Categories
    Route::get('categories', 'CategoryController@index');
});
