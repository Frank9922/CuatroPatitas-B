<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthRefugioController;
use App\Jobs\SendRegistrationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::prefix('refugio')->group(function () {

    Route::post('/', [AuthRefugioController::class, 'register']);
    Route::post('/login', [AuthRefugioController::class, 'login']);
    Route::get('/verify', [AuthRefugioController::class, 'verifyToken'])->name('verifyTokenRefugio');

    Route::middleware(['auth:sanctum'])->group(function () {

        Route::get('/refugio', [AuthRefugioController::class, 'refugio']);
        Route::get('/logout', [AuthRefugioController::class, 'logout']);

    });
});







