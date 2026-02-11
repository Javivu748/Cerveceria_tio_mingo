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
require __DIR__.'/auth.php';

