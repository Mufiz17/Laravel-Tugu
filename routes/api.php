<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenController;

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
