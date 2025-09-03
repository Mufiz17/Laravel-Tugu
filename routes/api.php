<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\API\AuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('absen')->controller(AbsenController::class)->group(function (){
    Route::get('/', 'index');
    Route::post('/', 'create');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('register','register');
    Route::post('login','login');

    Route::middleware(['jwt.cookie','jwt.auth'])->group(function () {
        Route::get('profile','profile');
        Route::post('logout','logout');
    });
});