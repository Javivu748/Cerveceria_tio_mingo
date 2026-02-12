<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CervezaController;
use Illuminate\Support\Facades\Route;
use App\Services\TelegramService;
use App\Http\Controllers\NosotrosController; 

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

//Ruta para la vista de nosotros
Route::middleware('auth')->group(function () {
    Route::get('/nosotros', [NosotrosController::class, 'index'])->name('nosotros.index');
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


Route::get('/cervezas', [CervezaController::class, 'index'])
     ->name('cervezas');
// Mostrar una cerveza individual
Route::get('/cervezas/{id}', [CervezaController::class, 'show'])
    ->name('cervezas.show');
require __DIR__.'/auth.php';

// API endpoints (compatibilidad local): exponer rutas de cambio bajo /api/currency
use App\Http\Controllers\ExchangeController;

Route::post('/api/currency/convert', [ExchangeController::class, 'convert']);
Route::get('/api/currency/rates', [ExchangeController::class, 'getRates']);

