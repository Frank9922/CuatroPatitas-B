<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MascotasController;
use App\Http\Controllers\Api\RefugioController;
use App\Http\Controllers\PruebaAuth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return ['Laravel' => app()->version(), 'php' => phpversion()];
});

Route::get('/test', function () {

    return ['message' => 'Hello World'];

});

Route::prefix('auth')->group(function () {

    Route::post('/refugio', [AuthController::class, 'registerRefugio']);
    Route::post('/refugio/login', [AuthController::class, 'loginRefugio']);

    
    Route::post('/', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    

    Route::get('/verify', [AuthController::class, 'verifyToken'])->name('verifyToken');

    Route::middleware(['auth.multi'])->group(function () {

        Route::get('/user', [AuthController::class, 'user']);
        Route::post('/logout', [AuthController::class, 'logout']);

    });

});

Route::get('mascotas', [MascotasController::class, 'index']);
Route::get('refugios', [RefugioController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

     Route::resource('mascotas', MascotasController::class)->except(['create', 'edit', 'index', 'show']);

     Route::prefix('/mascotas')->group(function () {

        Route::post('/adopcion', [MascotasController::class, 'adopcion']);
        Route::get('/user', [MascotasController::class, 'show']);


     });



});








