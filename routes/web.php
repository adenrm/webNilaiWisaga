<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminRegisterController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SuperAdminAuthController;

Route::get('/', function () {
    return view('auth.login');
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
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login');
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
Route::get('export/value', [ExcelController::class, 'exportValue'])->name('export.value');

// Route Superadmin Auth
Route::prefix('superadmin')->group(function () {
    Route::get('login', [SuperAdminAuthController::class, 'showLoginForm'])->name('superadmin.login');
    Route::post('login', [SuperAdminAuthController::class, 'login']);
    Route::post('logout', [SuperAdminAuthController::class, 'logout'])->name('superadmin.logout');
});

// Route Superadmin Dashboard (Protected)
Route::middleware(['auth:superadmin'])->prefix('superadmin')->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
    Route::get('/users', [SuperAdminController::class, 'users'])->name('superadmin.users');
    Route::get('/settings', [SuperAdminController::class, 'settings'])->name('superadmin.settings');
    Route::get('/nilai', [SuperAdminController::class, 'nilai'])->name('superadmin.nilai');
    Route::put('/profile', [SuperAdminController::class, 'updateProfile'])->name('superadmin.profile.update');
    Route::put('/password', [SuperAdminController::class, 'updatePassword'])->name('superadmin.password.update');
    Route::put('/notifications', [SuperAdminController::class, 'updateNotifications'])->name('superadmin.notifications.update');
    
    // User management routes
    Route::put('/users/{id}/status', [SuperAdminController::class, 'updateStatus'])->name('superadmin.users.updateStatus');
    Route::post('/users', [SuperAdminController::class, 'store'])->name('superadmin.users.store');
    Route::put('/users/{id}', [SuperAdminController::class, 'update'])->name('superadmin.users.update');
    Route::delete('/users/{id}', [SuperAdminController::class, 'destroy'])->name('superadmin.users.destroy');
});