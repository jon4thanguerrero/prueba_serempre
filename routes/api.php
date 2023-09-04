<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\City\CityController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\User\DeleteUserController;
use App\Http\Controllers\User\GetUserController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\UpdateUserController;
use App\Http\Controllers\User\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [
        'uses' => AuthController::class . '@login',
    ]);
});

Route::group(['prefix' => '/user', 'middleware' => 'auth.jwt'], function () {
    Route::get('/info', [
        'uses' => UserController::class . '@getInfo',
    ]);

    Route::post('/info', [
        'uses' => UserController::class . '@updateInfo',
    ]);
});

Route::group(['prefix' => '/clients'], function () {
    Route::get('/', [
        'uses' => ClientController::class,
    ]);
});


Route::group(['prefix' => '/cities'], function () {
    Route::get('/', [
        'uses' => CityController::class,
    ]);
});

/**
 * users CRUD
 */
Route::group(['prefix' => '/users'], function () {
    Route::post('/', [
        'uses' => RegisterController::class,
    ]);

    Route::get('/{id}', [
        'uses' => GetUserController::class,
    ]);

    Route::delete('/{id}', [
        'uses' => DeleteUserController::class,
    ]);

    Route::put('/{id}', [
        'uses' => UpdateUserController::class,
    ]);
});