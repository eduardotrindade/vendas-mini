<?php

use Illuminate\Support\Facades\Route;

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

// Redirecting any web route to the front-end
Route::get('/{vue_capture?}', function () {
    return File::get(public_path('index.html'));
})->where('vue_capture', '[@\/\w\.\-\+]*');
