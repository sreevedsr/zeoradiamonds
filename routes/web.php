<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RateController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\GoldRateController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\SupplierController;
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
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {

        Route::middleware(['auth', 'can:edit-cards'])->prefix('products')->name('products.')->group(function () {
            Route::get('register', [ProductController::class, 'create'])->name('register');
            Route::post('register', [ProductController::class, 'store'])->name('register');

            // Cards management
            Route::get('/', [CardsController::class, 'index'])->name('index');
            Route::get('/create', [CardsController::class, 'createCard'])->name('create');
            Route::post('/store', [CardsController::class, 'storeCard'])->name('store');
            Route::get('/assign', [CardsController::class, 'showAssignPage'])->name('assign');
            Route::post('/assign', [CardsController::class, 'assignCard'])->name('assign');
            Route::get('/requests', [DashboardController::class, 'customerRequests'])->name('requests');

            Route::get('/{id}', [CardsController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [CardsController::class, 'edit'])->name('edit');
            Route::put('/{id}', [CardsController::class, 'update'])->name('update');
            Route::delete('/{id}', [CardsController::class, 'destroy'])->name('destroy');
        });

        Route::middleware(['auth', 'can:view-suppliers'])->prefix('suppliers')->name('suppliers.')->group(function () {
            Route::get('/', [SupplierController::class, 'index'])->name('index');
            Route::get('/create', [SupplierController::class, 'create'])->name('create');
            Route::post('/store', [SupplierController::class, 'store'])->name('store');

            Route::get('/{id}/edit', [SupplierController::class, 'edit'])->name('edit');
            Route::put('/{id}', [SupplierController::class, 'update'])->name('update');
            Route::delete('/{id}', [SupplierController::class, 'destroy'])->name('destroy');
        });

        Route::middleware(['auth', 'can:view-rates'])->prefix('rates')->name('rates.')->group(function () {
            Route::get('/', [RateController::class, 'index'])->name('index');
            Route::post('/gold', [RateController::class, 'storeGold'])->name('gold.store');
            Route::post('/diamond', [RateController::class, 'storeDiamond'])->name('diamond.store');

        });
        Route::resource('staff', StaffController::class);


        // // Logs and requests
        // Route::get('/logs', [DashboardController::class, 'logs'])->name('logs');
        // Route::get('/requests', [DashboardController::class, 'requests'])->name('requests');

        // Merchant requests viewing
        Route::get('/merchants/requests', [MerchantRequestController::class, 'index'])->name('merchants.request');

        // Merchant management
        Route::middleware('can:view-merchants')->prefix('merchants')->name('merchants.')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('index');
            Route::get('/create', [AdminController::class, 'create'])->name('create');
            Route::post('/store', [AdminController::class, 'store'])->name('store');

            Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AdminController::class, 'update'])->name('update');
            Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy');

        });

    });

    // ================================
    // Merchant-only routes (Customer Management)
    // ================================
    Route::middleware('role:merchant')->prefix('merchant')->name('merchant.')->group(function () {

        // Customers management
        Route::prefix('customers')->name('customers.')->group(function () {
            Route::get('/', [MerchantController::class, 'customers'])->name('index');
            Route::get('/create', [DashboardController::class, 'createCustomer'])->name('create');
            Route::post('/', [MerchantController::class, 'storeCustomer'])->name('store');
        });
        Route::prefix('cards')->name('cards.')->group(function () {
            // 🟣 View all assigned diamond certificates
            Route::get('/', [AdminController::class, 'viewCards'])->name('index');

            // 🟢 Show assign-cards page (form + table)
            Route::get('/assign', [MerchantController::class, 'assignCardsPage'])->name('assign');

            // 🟠 Handle card assignment form submission
            Route::post('/assign', [MerchantController::class, 'assignCard'])->name('assign');
        });
        Route::prefix('marketplace')->name('marketplace.')->group(function () {
            // Route::get('/card-requests', [AdminController::class, 'viewRequests'])->name('cards.requests');
            Route::get('/request', [AdminController::class, 'requestCards'])->name('request');

            // View Requests page
            Route::get('/view', [AdminController::class, 'viewRequests'])->name('view');
        });

        // Requests management
        Route::get('/requests', [DashboardController::class, 'merchantRequests'])->name('merchant.requests');
        Route::post('/requests', [DashboardController::class, 'storeRequest'])->name('merchant.requests.store');
        Route::delete('/unassign-card/{id}', [AdminController::class, 'unassignCard'])->name('unassignCard');

    });

    // routes/web.php
    Route::get('/api/dropdown/{type}', [DropdownController::class, 'fetch'])->name('dropdown.fetch');

});

require __DIR__ . '/auth.php';
