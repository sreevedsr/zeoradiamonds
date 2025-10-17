<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\DashboardController;

// Redirect root URL to login
Route::get('/', function () {
    if (Auth::check()) {
        // User is logged in → redirect to their role dashboard
        return match (Auth::user()->role) {
            'admin', 'merchant' => redirect()->route('dashboard'),
            default => redirect()->route('login'),
        };
    }
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Shared dashboard for admin & merchant
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin-only routes
    Route::get('/cards', [DashboardController::class, 'cards'])->name('cards');
    Route::get('/cards/create', [DashboardController::class, 'createCard'])->name('cards.create');
    Route::post('/cards', [DashboardController::class, 'storeCard'])->name('cards.store');
    Route::get('/logs', [DashboardController::class, 'logs'])->name('logs');
    Route::get('/requests', [DashboardController::class, 'requests'])->name('requests');
    Route::get('/forms', [FormsController::class, 'index'])->name('forms.index');
    Route::post('/forms', [FormsController::class, 'store'])->name('forms.store');
    Route::get('/cards', [CardsController::class, 'index'])->name('cards.index');
    Route::post('/cards', [CardsController::class, 'store'])->name('cards.store');

    Route::middleware(['auth', 'can:view-merchants'])->prefix('admin')->name('merchants.')->group(function () {
    Route::get('/', [MerchantController::class, 'index'])->name('index'); // View Merchants
    Route::get('/create', [App\Http\Controllers\MerchantController::class, 'create'])->name('create'); // Add Merchant
    Route::post('/store', [App\Http\Controllers\MerchantController::class, 'store'])->name('store'); // Save Merchant
});



    // Merchant-only routes
    Route::get('/buyers', [DashboardController::class, 'buyers'])->name('buyers');
    Route::get('/buyers/create', [DashboardController::class, 'createBuyer'])->name('buyers.create');
    Route::post('/buyers', [DashboardController::class, 'storeBuyer'])->name('buyers.store');
    Route::get('/cards/assign', [DashboardController::class, 'assignCard'])->name('cards.assign');
    Route::post('/cards/assign', [DashboardController::class, 'storeAssignment'])->name('cards.assign.store');
    Route::get('/requests', [DashboardController::class, 'merchantRequests'])->name('merchant.requests');
    Route::post('/requests', [DashboardController::class, 'storeRequest'])->name('merchant.requests.store');
});


require __DIR__ . '/auth.php';
