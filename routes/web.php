<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DestinasiWisataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservasiWisataController;
use App\Http\Controllers\KomenController; 

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ReservasiAdminController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KomenController as AdminKomenController; 
use App\Http\Controllers\Admin\PromoController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('destinasi', DestinasiWisataController::class);
    
    Route::post('/destinasi/{destinasi}/komen', [KomenController::class, 'store'])->name('komen.store');
    Route::delete('/komen/{komen}', [KomenController::class, 'destroy'])->name('komen.destroy');

    Route::get('/reservasi', [ReservasiWisataController::class, 'index'])->name('reservasi.index');
    Route::post('/destinasi/{destinasi}/reservasi', [ReservasiWisataController::class, 'store'])->name('reservasi.store');
    Route::delete('/reservasi/{reservasi}', [ReservasiWisataController::class, 'destroy'])->name('reservasi.destroy');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('reservasi', ReservasiAdminController::class);
    Route::patch('/reservasi/{reservasi}/status', [ReservasiAdminController::class, 'updateStatus'])->name('reservasi.status');

    Route::resource('kategori', KategoriController::class);

    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('user.role');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/komen', [AdminKomenController::class, 'index'])->name('komen.index');
    Route::delete('/komen/{komen}', [AdminKomenController::class, 'destroy'])->name('komen.destroy');

    Route::get('/promo', [PromoController::class, 'index'])->name('promo.index');
    Route::patch('/promo/{destinasi}', [PromoController::class, 'update'])->name('promo.update');
});
Route::get('/tentang', function () {
    return view('tentang.index');  
})->name('tentang');

require __DIR__.'/auth.php';