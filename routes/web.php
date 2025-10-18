<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MerchantRequestController;

// Redirect root URL to login or dashboard
Route::get('/', function () {
    if (Auth::check()) {
        return match (Auth::user()->role) {
            'admin', 'merchant' => redirect()->route('dashboard'),
            default => redirect()->route('login'),
        };
    }
    return redirect()->route('login');
});

// Authenticated routes
Route::middleware('auth')->group(function () {

    // Profile routes (accessible to all authenticated users)
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Shared dashboard for admin & merchant
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ================================
    // Admin-only routes
    // ================================
    Route::middleware('role:admin')->group(function () {

        // Cards management
        Route::prefix('cards')->name('cards.')->group(function () {
            Route::get('/', [CardsController::class, 'index'])->name('index');
            Route::get('/create', [DashboardController::class, 'createCard'])->name('create');
            Route::post('/', [CardsController::class, 'store'])->name('store');
        });

        // Forms management
        Route::get('/forms', [FormsController::class, 'index'])->name('forms.index');
        Route::post('/forms', [FormsController::class, 'store'])->name('forms.store');

        // Logs and requests
        Route::get('/logs', [DashboardController::class, 'logs'])->name('logs');
        Route::get('/requests', [DashboardController::class, 'requests'])->name('requests');

        // Merchant management
        Route::middleware('can:view-merchants')->prefix('admin/merchants')->name('merchants.')->group(function () {
            Route::get('/', [MerchantController::class, 'index'])->name('index');       // View merchants
            Route::get('/create', [MerchantController::class, 'create'])->name('create'); // Add merchant
            Route::post('/store', [MerchantController::class, 'store'])->name('store');  // Save merchant
        });

        // Merchant requests viewing
        Route::get('/merchants/requests', [MerchantRequestController::class, 'index'])->name('merchants.request');
    });

    // ================================
    // Merchant-only routes
    // ================================
    Route::middleware('role:merchant')->group(function () {

        // Buyers management
        Route::prefix('buyers')->name('buyers.')->group(function () {
            Route::get('/', [DashboardController::class, 'buyers'])->name('index');
            Route::get('/create', [DashboardController::class, 'createBuyer'])->name('create');
            Route::post('/', [DashboardController::class, 'storeBuyer'])->name('store');
        });

        // Card assignment
        Route::get('/cards/assign', [DashboardController::class, 'assignCard'])->name('cards.assign');
        Route::post('/cards/assign', [DashboardController::class, 'storeAssignment'])->name('cards.assign.store');

        // Requests management
        Route::get('/requests', [DashboardController::class, 'merchantRequests'])->name('merchant.requests');
        Route::post('/requests', [DashboardController::class, 'storeRequest'])->name('merchant.requests.store');
    });

});

require __DIR__ . '/auth.php';
