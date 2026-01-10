<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// ========== ROUTES PUBLIQUES ==========
Route::get('/', function () {
    return redirect('/login');
});

// Login (accessible seulement aux invités)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// ========== ROUTES PROTÉGÉES ==========
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Admin dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    
    // Sessions
    Route::post('/admin/sessions', [AdminController::class, 'store'])->name('admin.sessions.store');
    // Dans le groupe auth, après les autres routes
Route::get('/admin/sessions/create', [AdminController::class, 'create'])->name('admin.sessions.create');
    Route::get('/admin/sessions/{id}/edit', [AdminController::class, 'edit'])->name('admin.sessions.edit');
    Route::put('/admin/sessions/{id}', [AdminController::class, 'update'])->name('admin.sessions.update');
    Route::delete('/admin/sessions/{id}', [AdminController::class, 'destroy'])->name('admin.sessions.destroy');
    
    // Lien d'appel
    Route::post('/admin/sessions/{id}/call-link', [AdminController::class, 'storeCallLink'])
         ->name('admin.sessions.call-link.store');
});

// ========== API ROUTES ==========
Route::prefix('api')->group(function () {
    Route::get('/sessions', [AdminController::class, 'getSessions']);
    Route::get('/call-link/{sessionId}', [AdminController::class, 'getCallLink']);
});

// Fallback
Route::fallback(function () {
    return redirect('/login');
});