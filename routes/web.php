<?php

use App\Http\Controllers\BalanceTransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
    /*   return Inertia::render('Welcome', [
          'canLogin' => Route::has('login'),
          'canRegister' => Route::has('register'),
          'laravelVersion' => Application::VERSION,
          'phpVersion' => PHP_VERSION,
      ]); */
});

Route::get('/about', function () {
    return Inertia::render('About');
});
Route::post('/balance-transactions', [BalanceTransactionController::class, 'store'])->name('checkout.process');
Route::get('/withdrawal', function () {
    return Inertia::render('Withdrawal');
});
Route::get('/basket', function () {
    return Inertia::render('Baskets');
})->middleware(['auth']);

Route::get('/contact', function () {
    return Inertia::render('Contact');
});
Route::get('/dashboard', function () {

    return Inertia::render('Dashboard', [
        'user' => auth()->user(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/shop', [ProductController::class, 'index']);
Route::get('/shop/{id}', [ProductController::class, 'productDetails'])->middleware(['auth']);
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
