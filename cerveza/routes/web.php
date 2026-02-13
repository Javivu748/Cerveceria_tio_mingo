<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CervezaController;
use Illuminate\Support\Facades\Route;
use App\Services\TelegramService;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cervezas', function () {
    return view('cervezas');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Rutas para pedidos
use App\Http\Controllers\PedidoController;

Route::middleware(['auth'])->group(function () {

    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');

    Route::get('/pedidos/crear', [PedidoController::class, 'create'])->name('pedidos.create');

    Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');

    Route::delete('/pedidos/{pedido}', [PedidoController::class, 'destroy'])->name('pedidos.destroy');
});





Route::get('/test-telegram', function() {
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


use App\Http\Controllers\PayPalController;

// ════════════════════════════════════════
// RUTAS DE PAYPAL
// ════════════════════════════════════════

// Procesar pago
Route::post('/paypal/payment', [PayPalController::class, 'createPayment'])
    ->name('paypal.payment')
    ->middleware('auth');

// PayPal redirige aquí cuando el pago es exitoso
Route::get('/paypal/success', [PayPalController::class, 'paymentSuccess'])
    ->name('paypal.success')
    ->middleware('auth');

// PayPal redirige aquí si el usuario cancela
Route::get('/paypal/cancel', [PayPalController::class, 'paymentCancel'])
    ->name('paypal.cancel')
    ->middleware('auth');


require __DIR__.'/auth.php';

