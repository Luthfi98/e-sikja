<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\RequestTypeController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('layouts.cms');
});
Route::get('/dashboard', function () {
    return view('layouts.cms');
});

// Authentication Routes
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'doregister']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    
    Route::prefix('data-masyarakat')->group(function () {
        Route::get('/', [ResidentController::class, 'index'])->name('data-masyarakat.index');
        Route::get('/create', [ResidentController::class, 'create'])->name('data-masyarakat.create');
        Route::post('/store', [ResidentController::class, 'store'])->name('data-masyarakat.store');
        Route::get('/edit/{id}', [ResidentController::class, 'edit'])->name('data-masyarakat.edit');
        Route::put('/update/{id}', [ResidentController::class, 'update'])->name('data-masyarakat.update');
        Route::delete('/delete/{id}', [ResidentController::class, 'destroy'])->name('data-masyarakat.destroy');
    });
    
    Route::prefix('manajemen-pengguna')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('manajemen-pengguna.index');
        Route::get('/create', [UserController::class, 'create'])->name('manajemen-pengguna.create');
        Route::post('/store', [UserController::class, 'store'])->name('manajemen-pengguna.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('manajemen-pengguna.edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('manajemen-pengguna.update');
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('manajemen-pengguna.destroy');
    });

    Route::prefix('jenis-permohonan')->group(function () {
        Route::get('/', [RequestTypeController::class, 'index'])->name('jenis-permohonan.index');
        Route::get('/create', [RequestTypeController::class, 'create'])->name('jenis-permohonan.create');
        Route::post('/store', [RequestTypeController::class, 'store'])->name('jenis-permohonan.store');
        Route::get('/show/{id}', [RequestTypeController::class, 'show'])->name('jenis-permohonan.show');
        Route::get('/edit/{id}', [RequestTypeController::class, 'edit'])->name('jenis-permohonan.edit');
        Route::put('/update/{id}', [RequestTypeController::class, 'update'])->name('jenis-permohonan.update');
        Route::delete('/delete/{id}', [RequestTypeController::class, 'destroy'])->name('jenis-permohonan.destroy');
    });

    Route::prefix('notifikasi')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('notifikasi.index');
        Route::post('{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifikasi.mark-as-read');
        Route::post('mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifikasi.mark-all-read');

    });


    Route::prefix('verifikasi-pendaftaran')->group(function () {
        Route::get('{id}', [UserController::class, 'verification'])->name('verifikasi-pendaftaran.index');
        Route::post('{id}/verify', [UserController::class, 'verify'])->name('verifikasi-pendaftaran.verify');
    });
});

// Route::resource('data-masyarakat', ResidentController::class);
