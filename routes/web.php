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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.main');
});

Route::namespace('Dashboard')
    ->prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {
        // Items
        Route::namespace('Item')
            ->group(function () {
                // Resource
                Route::resource('items', 'ItemController');
            });
});
