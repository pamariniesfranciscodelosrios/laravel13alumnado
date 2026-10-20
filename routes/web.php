<?php

use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});


use App\Http\Controllers\AlumnoController;

Route::get('/', [AlumnoController::class, 'index']);

Route::get('/alumnos', [AlumnoController::class, 'index']);