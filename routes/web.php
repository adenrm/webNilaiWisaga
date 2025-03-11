<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminRegisterController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\NilaiController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::prefix('admin')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::get('register', [AdminRegisterController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('register', [AdminRegisterController::class, 'register']);
});

Route::middleware(['admin'])->group(function () {
    Route::get('admin/dashboard', [AdminAuthController::class, 'index'])->name('admin.dashboard');
});

Route::put('/nilai/{id}', [NilaiController::class, 'update'])->name('nilai.update');
Route::delete('/nilai/{id}', [NilaiController::class, 'destroy'])->name('nilai.destroy');
Route::post('/nilai', [NilaiController::class, 'store'])->name('nilai.store');



// Route Excel
Route::get('export/value', [ExcelController::class, 'exportValue']);