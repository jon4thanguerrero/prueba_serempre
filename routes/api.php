<?php

use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\UserController;
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


Route::group(['prefix' => '/users'], function () {
    Route::post('/', [
        'uses' => RegisterController::class,
    ]);

    Route::get('/', [
        'uses' => RegisterController::class,
    ]);

    Route::delete('/{id}', [
        'uses' => RegisterController::class,
    ]);

    Route::put('/{id}', [
        'uses' => RegisterController::class,
    ]);
});
