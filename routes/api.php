<?php

use App\Http\Controllers\{OrdersController, PeopleController, ProfilesController, StatesController};
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

Route::get('/people', [PeopleController::class, 'index']);
Route::post('/people', [PeopleController::class, 'store']);
Route::get('/people/{people}', [PeopleController::class, 'show']);
Route::put('/people/{people}', [PeopleController::class, 'update']);
Route::post('/people/document-number', [PeopleController::class, 'showDocumentNumber']);

Route::get('/profiles/{profile}/products', [ProfilesController::class, 'showProducts']);

Route::post('/orders', [OrdersController::class, 'store']);

Route::get('/states', [StatesController::class, 'index']);
Route::get('/states/{state}/cities', [StatesController::class, 'showCities']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
