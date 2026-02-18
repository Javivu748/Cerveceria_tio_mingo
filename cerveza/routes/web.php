<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CervezaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\NosotrosController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ComentarioController;
use App\Models\Comentario;


//Comentarios
Route::get('/', function () {
    $comentarios = Comentario::inRandomOrder()->get();
    return view('welcome', compact('comentarios'));
})->name('home');

Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');

// Dashboard
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Mi perfil con información y pedidos

});

// Nosotros (solo usuarios autenticados)
Route::middleware('auth')->get('/nosotros', [NosotrosController::class, 'index'])->name('nosotros.index');

// Dashboard Admin (solo usuarios autenticados con role ADMIN)
Route::middleware(['auth', 'verified', 'ADMIN'])->group(function () {
    Route::get('/admin/usuarios', [UserController::class, 'dashboard'])->name('admin.usuarios');
    Route::get('/usuario/{id}', [UserController::class, 'userProfile'])->name('user.profile');
    Route::post('/eliminar-cuenta/{id}', [UserController::class, 'eliminar'])->name('user.eliminar');

    //Route de cerveza
    Route::get('/admin/cervezas', [CervezaController::class, 'adminIndex'])->name('admin.cervezas');
    Route::get('/admin/cervezas/crear', [CervezaController::class, 'create'])->name('admin.cervezas.create');
    Route::post('/admin/cervezas', [CervezaController::class, 'store'])->name('admin.cervezas.store');
    Route::get('/admin/cervezas/{id}/editar', [CervezaController::class, 'edit'])->name('admin.cervezas.edit');
    Route::patch('/admin/cervezas/{id}', [CervezaController::class, 'update'])->name('admin.cervezas.update');
    Route::delete('/admin/cervezas/{id}', [CervezaController::class, 'destroy'])->name('admin.cervezas.destroy');
});

// Cervezas
Route::get('/cervezas', [CervezaController::class, 'index'])->name('cervezas');
Route::get('/cervezas/{id}', [CervezaController::class, 'show'])->name('cervezas.show');

// Pedidos y PayPal (solo usuarios autenticados)
Route::middleware('auth')->group(function () {

    // Pedidos
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos/crear', [PedidoController::class, 'create'])->name('pedidos.create');
    Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');
    Route::get('/pedidos/{id}/detalle', [PedidoController::class, 'detalle'])->name('pedidos.detalle');
    Route::delete('/pedidos/{id}', [PedidoController::class, 'destroy'])->name('pedidos.destroy');
    Route::get('/editar', [UserController::class, 'editar'])->name('editar.perfil');
    Route::patch('/usuario/{id}', [UserController::class, 'update'])->name('user.update');

    // PayPal
    Route::post('/paypal/payment', [PayPalController::class, 'createPayment'])->name('paypal.payment');
    Route::get('/paypal/success', [PayPalController::class, 'paymentSuccess'])->name('paypal.success');
    Route::get('/paypal/cancel', [PayPalController::class, 'paymentCancel'])->name('paypal.cancel');
});

// Test Telegram
Route::get('/test-telegram', function () {
    $telegram = new \App\Services\TelegramService();

    try {
        $result = $telegram->sendTestMessage();
        return [
            'success' => $result,
            'message' => $result ? 'Mensaje enviado' : 'Error al enviar'
        ];
    } catch (\Exception $e) {
        return [
            'error' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ];
    }
});


Route::get('/cervezas', [CervezaController::class, 'index'])
    ->name('cervezas');
// Mostrar una cerveza individual
Route::get('/cervezas/{id}', [CervezaController::class, 'show'])
    ->name('cervezas.show');
require __DIR__ . '/auth.php';


Route::post('/api/currency/convert', [ExchangeController::class, 'convert']);
Route::get('/api/currency/rates', [ExchangeController::class, 'getRates']);

Route::post('/perfil/ubicacion', [UserController::class, 'updateLocation'])->name('profile.location.update');
