<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChannelController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // Vista principal con canales
    Route::get('/home', [ChannelController::class, 'index'])
        ->name('home.index');
    // Suscribirse
    Route::post('/subscribirse/{id}', [ChannelController::class, 'subscribirse'])
        ->name('subscribe');
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

Route::post('/suscribirse', [AuthController::class, 'suscribirse'])
    ->name('suscribirse');

//Ruta para el dashboard del admin
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin-dashboard', [ChannelController::class, 'adminIndex'])
    ->name('admin.dashboard')
    ->middleware(['auth','admin']);

    Route::get('/admin.create', [ChannelController::class, 'create'])
        ->name('admin.create');

    Route::post('/admin.store', [ChannelController::class, 'store'])
        ->name('admin.store');
    
    Route::get('/admin.edit/{id}', [ChannelController::class, 'edit'])
        ->name('admin.edit');

    Route::put('/admin.update/{id}', [ChannelController::class, 'update'])
        ->name('admin.update');

    Route::delete('/admin.delete/{id}', [ChannelController::class, 'destroy'])
        ->name('admin.delete');
});