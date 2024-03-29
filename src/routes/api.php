<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'login']);
    Route::post('logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);
    Route::post('refresh', [\App\Http\Controllers\API\AuthController::class, 'refresh']);
    Route::post('me', [\App\Http\Controllers\API\AuthController::class, 'me']);
});

Route::middleware('auth:api')->prefix('v1')->group(function() {
    Route::resource('application', \App\Http\Controllers\API\ApplicationController::class)->except(
        ['update','create', 'edit']
    );
    Route::resource('race', \App\Http\Controllers\API\RaceController::class)->except(
        ['create', 'edit']
    );

});
