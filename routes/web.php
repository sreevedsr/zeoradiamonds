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
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {

        // Cards management
        Route::prefix('cards')->name('cards.')->group(function () {
            Route::get('/', [CardsController::class, 'index'])->name('index');
            Route::get('/create', [DashboardController::class, 'createCard'])->name('create');
            Route::post('/', [CardsController::class, 'store'])->name('store');
            Route::get('/assign', [CardsController::class, 'showAssignPage'])->name('assign');
            Route::get('/requests', [DashboardController::class, 'customerRequests'])->name('requests');

            Route::get('/{id}', [CardsController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [CardsController::class, 'edit'])->name('edit');
            Route::put('/{id}', [CardsController::class, 'update'])->name('update');
            Route::delete('/{id}', [CardsController::class, 'destroy'])->name('destroy');
        });

        // Forms management
        Route::get('/forms', [FormsController::class, 'index'])->name('forms.index');
        Route::post('/forms', [FormsController::class, 'store'])->name('forms.store');

        // Logs and requests
        Route::get('/logs', [DashboardController::class, 'logs'])->name('logs');
        Route::get('/requests', [DashboardController::class, 'requests'])->name('requests');

        Route::get('/merchants/requests', [MerchantRequestController::class, 'index'])->name('merchants.request');
        // Merchant management
        Route::middleware('can:view-merchants')->prefix('merchants')->name('merchants.')->group(function () {
            Route::get('/', [MerchantController::class, 'index'])->name('index');       // View merchants
            Route::get('/create', [MerchantController::class, 'create'])->name('create'); // Add merchant
            Route::post('/store', [MerchantController::class, 'store'])->name('store');  // Save merchant

            Route::get('/{id}/edit', [MerchantController::class, 'edit'])->name('edit');   // Edit form
            Route::put('/{id}', [MerchantController::class, 'update'])->name('update');    // Update record
            Route::delete('/{id}', [MerchantController::class, 'destroy'])->name('destroy'); // Delete merchant

        });

        // Merchant requests viewing
    });

    // ================================
// Merchant-only routes (Customer Management)
// ================================
    Route::middleware('role:merchant')->prefix('merchant')->name('merchant.')->group(function () {

        // Customers management
        Route::prefix('customers')->name('customers.')->group(function () {
            Route::get('/', [DashboardController::class, 'customers'])->name('index');         // View customers
            Route::get('/create', [DashboardController::class, 'createCustomer'])->name('create'); // Add customer
            Route::post('/', [DashboardController::class, 'storeCustomer'])->name('store');     // Save customer
        });
        Route::prefix('cards')->name('cards.')->group(function () {
            // 🟣 View all assigned diamond certificates
            Route::get('/', [MerchantController::class, 'viewCards'])->name('index');

            // 🟢 Show assign-cards page (form + table)
            Route::get('/assign', [MerchantController::class, 'assignCardsPage'])->name('assign');

            // 🟠 Handle card assignment form submission
            Route::post('/assign', [MerchantController::class, 'assignCard'])->name('assign');
        });
        Route::prefix('marketplace')->name('marketplace.')->group(function () {
            // Route::get('/card-requests', [MerchantController::class, 'viewRequests'])->name('cards.requests');
            Route::get('/request', [MerchantController::class, 'requestCards'])->name('request');

            // View Requests page
            Route::get('/view', [MerchantController::class, 'viewRequests'])->name('view');
        });

        // Card assignment
        // Route::get('/cards/assign', [DashboardController::class, 'assignCard'])->name('cards.assign');
        // Route::post('/cards/assign', [DashboardController::class, 'storeAssignment'])->name('cards.assign.store');

        // Requests management
        Route::get('/requests', [DashboardController::class, 'merchantRequests'])->name('merchant.requests');
        Route::post('/requests', [DashboardController::class, 'storeRequest'])->name('merchant.requests.store');





        // 🔴 Handle card unassignment (delete assignment)
        Route::delete('/unassign-card/{id}', [MerchantController::class, 'unassignCard'])->name('unassignCard');

        // Optional: If you plan to show card requests

    });
});

require __DIR__ . '/auth.php';
