<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware('auth')->prefix('/app')->name('app.')->group(function() {
    Route::get('/', [App\Http\Controllers\AppController::class, 'index'])->name('homepage');
    Route::get('/races', [\App\Http\Controllers\RaceController::class, 'index'])->name('races.index');
    Route::get('/races/{race_id}/new-application', [\App\Http\Controllers\RaceController::class, 'newApplication'])->name('races.new_application');
    Route::post('/races/new-application', [\App\Http\Controllers\RaceController::class, 'applicationSave'])->name('races.save_application');
    Route::get('/applications/my', [\App\Http\Controllers\ApplicationController::class, 'myApplications'])->name('applications.my');
    Route::delete('/applications/{id}', [\App\Http\Controllers\ApplicationController::class, 'destroy'])->name('applications.delete');
});
