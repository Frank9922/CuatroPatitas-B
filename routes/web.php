<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version(), 'php' => phpversion()];
});

require __DIR__.'/auth.php';
