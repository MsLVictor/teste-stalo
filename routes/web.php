<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Models\Transaction;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('transactions.index');
})->middleware(['auth', 'verified'])->name('dashboard');
    

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('transactions', TransactionController::class);
});


require __DIR__.'/auth.php';

Route::middleware(['tenant','web'])->group(function () {
    // Breeze auth DENTRO do tenant: /t/{tenant}/login, /register etc.
    require __DIR__.'/auth.php';

    // após login, ir para a lista
    Route::get('/dashboard', fn () => redirect()->route('transactions.index'))
        ->middleware(['auth','verified'])
        ->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::resource('transactions', TransactionController::class);
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});