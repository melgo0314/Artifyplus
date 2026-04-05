<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PaymentController;

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


Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin/usuarios/crear', [AdminController::class, 'create'])
        ->name('admin.users.create');

    Route::post('/admin/usuarios', [AdminController::class, 'store'])
        ->name('admin.usuarios.store');

    Route::get('/admin/usuarios', [AdminController::class, 'index'])
        ->name('admin.usuarios');

    Route::get('/admin/usuarios/{id}/editar', [AdminController::class, 'edit'])
        ->name('admin.users.editar');

    Route::put('/admin/usuarios/{id}', [AdminController::class, 'update'])
        ->name('admin.users.update');

    Route::delete('/admin/usuarios/{id}', [AdminController::class, 'destroy'])
        ->name('admin.users.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/videos/{video}/comentarios', [CommentController::class, 'index'])
        ->name('comments.index');

    Route::post('/comentarios', [CommentController::class, 'store'])
        ->name('comments.store');

    Route::get('/comentarios/{id}/editar', [CommentController::class, 'edit'])
        ->name('comments.edit');

    Route::put('/comentarios/{id}', [CommentController::class, 'update'])
        ->name('comments.update');

    Route::delete('/comentarios/{id}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');
});

Route::get('/canal/{id}', [VideoController::class, 'index'])
    ->name('canal.videos');

Route::get('/videos/{id}', [VideoController::class, 'show'])
    ->name('videos.show');

Route::middleware(['auth','admin'])->group(function () {

    Route::get('/admin/videos', [VideoController::class, 'adminIndex'])
    ->name('admin.videos');

    Route::get('/admin/videos/create', [VideoController::class, 'create'])
    ->name('admin.videos.create');

    Route::post('/admin/videos', [VideoController::class, 'store'])
    ->name('admin.videos.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/mis-suscripciones', [SubscriptionController::class, 'index'])
        ->name('home.suscripciones');
    
    Route::put('/suscripciones/{id}/cancelar', [SubscriptionController::class, 'cancel'])
    ->name('subscriptions.cancel');

    Route::put('/suscripciones/{id}/renovar', [SubscriptionController::class, 'renew'])
    ->name('subscriptions.renew');
});



Route::middleware(['auth'])->group(function () {

    Route::get('/pagar/{channel}', [PaymentController::class, 'pagar'])->name('pagar');

    Route::get('/success', [PaymentController::class, 'success'])->name('pago.success');
    Route::get('/failure', [PaymentController::class, 'failure'])->name('pago.failure');
    Route::get('/pending', [PaymentController::class, 'pending'])->name('pago.pending');
});



Route::post('/webhook/mercadopago', [PaymentController::class, 'webhook']);