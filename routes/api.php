<?php

use App\Http\Controllers\{AuthController,
    ContaAzulController,
    OrdersController,
    PeopleController,
    ProfilesController,
    StatesController};
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

Route::get('states', [StatesController::class, 'index']);
Route::get('states/{state}/cities', [StatesController::class, 'showCities'])->where('state', '[0-9]+');

Route::post('people', [PeopleController::class, 'store']);
Route::post('people/document-number', [PeopleController::class, 'showDocumentNumber']);

Route::get('profiles/{profile}/products', [ProfilesController::class, 'showProducts'])->where('profile', '[0-9]+');

Route::post('orders', [OrdersController::class, 'store']);
Route::post('orders/payment-notification', [OrdersController::class, 'paymentNotification'])->name('paymentNotification');

Route::get('conta-azul/token', [ContaAzulController::class, 'token'])->name('contaAzulToken');
Route::get('conta-azul/refresh-token', [ContaAzulController::class, 'refreshToken']);

Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });

    Route::prefix('people')->group(function () {
        Route::get('', [PeopleController::class, 'index']);
        Route::get('{people}', [PeopleController::class, 'show'])->where('people', '[0-9]+');
        Route::put('{people}', [PeopleController::class, 'update'])->where('people', '[0-9]+');
        Route::patch('{people}/change-active', [PeopleController::class, 'changeActive'])->where('people', '[0-9]+');
        Route::get('export', [PeopleController::class, 'export']);
    });

    Route::prefix('orders')->group(function () {
        Route::get('', [OrdersController::class, 'index']);
        Route::get('export', [OrdersController::class, 'export']);
    });

    Route::get('conta-azul/authorize', [ContaAzulController::class, 'auth']);
});
