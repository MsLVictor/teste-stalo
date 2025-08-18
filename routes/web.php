<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

// (central opcional)
Route::get('/', fn () => view('welcome'));

// tudo do tenant: /t/{tenant}/...
Route::group([
    'prefix' => '/t/{tenant}',
    'middleware' => [
        'web',
        InitializeTenancyByPath::class,
        PreventAccessFromCentralDomains::class,
    ],
], function () {
    // Auth do Breeze dentro do tenant
    require __DIR__ . '/auth.php';

    // após login, manda pra lista
    Route::get('/dashboard', fn () => redirect()->route('transactions.index'))
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::resource('transactions', TransactionController::class);
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // rota de teste
    Route::get('/ping', fn () => 'pong-tenant')->name('tenant.ping');
});
