<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', '/login');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [WalletController::class, 'index'])->name('dashboard');

    Route::resource('siswas', UserController::class);
    Route::post('/wallet/topup', [WalletController::class, 'topUp'])->name('wallet.topup');
    Route::post('/wallet/pay', [WalletController::class, 'pay'])->name('wallet.pay');
    Route::resource('transaksis', TransaksiController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
