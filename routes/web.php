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

Route::get('/', function () {
    return view('dashboard.main');
});

Route::get('/foo', function () {
    Artisan::call('storage:link');
});

Route::post('/upload', function () {
    if (!is_null(request()->file('file')))
    {
        $image = Storage::put("public/announcement", request()->file('file'));
        dd($image);
    }
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
