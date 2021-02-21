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
Route::get('states/{state}/cities', [StatesController::class, 'showCities']);

Route::post('people', [PeopleController::class, 'store']);
Route::post('people/document-number', [PeopleController::class, 'showDocumentNumber']);

Route::get('profiles/{profile}/products', [ProfilesController::class, 'showProducts']);

Route::post('orders', [OrdersController::class, 'store']);
Route::post('orders/payment-notification', [OrdersController::class, 'paymentNotification'])->name('paymentNotification');

Route::get('conta-azul/token', [ContaAzulController::class, 'token'])->name('contaAzulToken');

Route::middleware('api')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });

    Route::prefix('people')->group(function () {
        Route::get('', [PeopleController::class, 'index']);
        Route::get('{people}', [PeopleController::class, 'show']);
        Route::put('{people}', [PeopleController::class, 'update']);
        Route::patch('{people}/active', [PeopleController::class, 'active']);
    });

    Route::get('orders', [OrdersController::class, 'index']);

    Route::prefix('conta-azul')->group(function () {
        Route::get('authorize', [ContaAzulController::class, 'auth']);
        Route::get('refresh-token', [ContaAzulController::class, 'refreshToken']);
    });
});
