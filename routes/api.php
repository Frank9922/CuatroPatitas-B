<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthRefugioController;
use Illuminate\Support\Facades\Route;




Route::prefix('auth')->group(function () {

    Route::post('/', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/verify', [AuthController::class, 'verifyToken'])->name('verifyToken');

    Route::middleware(['auth:sanctum'])->group(function () {

        Route::get('/user', [AuthController::class, 'user']);
        Route::post('/logout', [AuthController::class, 'logout']);

    });

});









