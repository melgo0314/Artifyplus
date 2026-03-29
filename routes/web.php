<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('home.index');
    })->name('home.index');
});

//Ruta para el formulario de registro
Route::get('/registro', [AuthController::class, 'registerForm'
])->name('registro');

//Ruta para ejecutar el formulario
Route::post('/registro', [AuthController::class, 'register'
])->name('registro.store');

//Ruta para manejar la vista del inicio de sesion
Route::get('/acceso', [AuthController::class, 'loginForm'
])->name('acceso');

//Ruta para manejar los datos de inicio
Route::post('/acceso', [AuthController::class, 'login'
])->name('acceso.store');

//Ruta para cerrar sesion
Route::post('/cerrar', [AuthController::class, 'logout'
])->name('cerrar');



Route::middleware(['auth','admin'])->group(function() {
    Route::get('/admin.dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');
});

Route::post('/suscribirse', [AuthController::class, 'suscribirse'])
    ->name('suscribirse');

