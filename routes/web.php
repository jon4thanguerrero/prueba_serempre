<?php

use App\Http\Controllers\Client\ClientImportExportController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/clients'], function () {
    Route::get('/import', [
        'uses' => ClientImportExportController::class.'@index',
    ]);

    Route::post('/import', [
        'uses' => ClientImportExportController::class.'@import',
        'as' => 'import-clients'
    ]);

    Route::get('/export', [
        'uses' => ClientImportExportController::class.'@export',
        'as' => 'export-clients'
    ]);
});
