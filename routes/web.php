<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [OrderController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus']);
Route::post('/orders/{order}/notify', [OrderController::class, 'notify'])->name('orders.notify');
Route::resource('/orders', OrderController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
