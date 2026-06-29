<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Import Semua Controller
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. AUTHENTICATION (Login & Logout)
// ==========================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware(['guest', 'throttle:5,1']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware(['auth', 'throttle:10,1']);


// ==========================================
// 2. PROTECTED ROUTES (Requires Login)
// ==========================================
Route::middleware(['auth'])->group(function () {
    // PROFIL SAYA (PROFILE)
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // DASHBOARD
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // KATALOG MENU KUE (PRODUCTS)
    Route::prefix('products')->middleware('role:owner,kasir')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::post('/', [ProductController::class, 'store'])->name('products.store');
        Route::put('/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::post('/update-stock', [ProductController::class, 'updateStock'])->name('products.update_stock');
    });

    // KATEGORI KUE (CATEGORIES)
    Route::prefix('categories')->middleware('role:owner,kasir')->group(function () {
        Route::get('/', [\App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
        Route::post('/', [\App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
        Route::put('/{id}', [\App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/{id}', [\App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    // STOK BAHAN BAKU (MATERIALS)
    Route::prefix('materials')->middleware('role:owner,produksi')->group(function () {
        Route::get('/', [MaterialController::class, 'index'])->name('materials.index');
        Route::post('/store', [MaterialController::class, 'store'])->name('materials.store');
        Route::post('/update-stock', [MaterialController::class, 'updateStock'])->name('materials.update_stock');
        Route::put('/{id}', [MaterialController::class, 'update'])->name('materials.update');
    });

    // PESANAN PRODUKSI (ORDER MANAGEMENT)
    Route::prefix('orders')->middleware('role:owner,produksi,kasir')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::post('/', [OrderController::class, 'store'])->name('orders.store');
        Route::put('/{id}', [OrderController::class, 'update'])->name('orders.update');
    });

    // RESEP MASTER (RECIPES)
    Route::prefix('recipes')->middleware('role:owner,produksi')->group(function () {
        Route::get('/', [RecipeController::class, 'index'])->name('recipes.index');
        Route::post('/', [RecipeController::class, 'store'])->name('recipes.store');
        Route::put('/{id}', [RecipeController::class, 'update'])->name('recipes.update');
        Route::delete('/{id}', [RecipeController::class, 'destroy'])->name('recipes.destroy');
    });

    // TRANSAKSI PEMBAYARAN
    Route::prefix('transactions')->middleware('role:owner,kasir')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');
        Route::post('/', [TransactionController::class, 'store'])->name('transactions.store');
        Route::put('/{id}/settle', [TransactionController::class, 'settle'])->name('transactions.settle');
    });

    // LAPORAN OPERASIONAL
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index')->middleware('role:owner');

    // MANAJEMEN USER (USER MANAGEMENT)
    Route::prefix('users')->middleware('role:owner')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});
