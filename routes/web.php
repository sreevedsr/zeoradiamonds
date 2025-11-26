<?php

use App\Models\TempPurchaseItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TempSaleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\SaleAssignController;
use App\Http\Controllers\Cards\CardsController;
use App\Http\Controllers\MerchantRequestController;
use App\Http\Controllers\TempPurchaseItemController;
use App\Http\Controllers\Cards\CardAssignmentController;
use App\Http\Controllers\Admin\Reports\SalesReportController;
use App\Http\Controllers\Admin\Reports\SalesmanReportController;


Route::get('/admin/debug/cards', function () {
    return [
        'cards' => \App\Models\Card::all(),
        'ownerships' => \App\Models\CardOwnership::all(),
        'admin_owned_cards' => \App\Models\Card::ownedByAdmin()->get(),
    ];
});

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

    Route::get('/qr/{id}', function ($id) {
        // QR payload should ONLY contain an ID
        $payload = json_encode(['id' => (int) $id]);

        return response(
            QrCode::format('svg')->size(200)->generate($payload),
            200,
            ['Content-Type' => 'image/svg+xml']
        );
    })->where('id', '[0-9]+');

    Route::get('/scan/{id}', function ($id) {

        $item = TempPurchaseItem::findOrFail($id);

        $goldRate = DB::table('gold_rates')
            ->orderBy('created_at', 'desc')
            ->value('rate');

        return response()->json([
            'product_code' => $item->product_code,
            'mrp' => $item->mrp_cost,
            'gold_rate' => $goldRate, // always LIVE
        ]);
    });

    // ================================
    // Admin-only routes
    // ================================
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {

        Route::get('/temp-items', [TempPurchaseItemController::class, 'index']);
        Route::post('/temp-items', [TempPurchaseItemController::class, 'store']);
        Route::put('/temp-items/{id}', [TempPurchaseItemController::class, 'update']);
        Route::delete('/temp-items/{id}', [TempPurchaseItemController::class, 'destroy']);
        Route::delete('/temp-items', [TempPurchaseItemController::class, 'clearAll']);

        Route::post('temp-sales', [TempSaleController::class, 'store']);
        Route::get('temp-sales', [TempSaleController::class, 'index']);
        Route::delete('temp-sales/{tempSale}', [TempSaleController::class, 'destroy']);

        Route::post('sales/finalize', [SaleAssignController::class, 'finalize'])->name('admin.sales.finalize');

        Route::prefix('reports')->name('reports.')->group(function () {

            Route::get('/purchase', [CardsController::class, 'index'])
                ->name('purchase');

            Route::get('/sales', [SalesReportController::class, 'index'])
                ->name('sales');

            Route::get('/salesman', [SalesmanReportController::class, 'index'])
                ->name('salesman');

        });

        Route::middleware(['auth', 'can:edit-cards'])->prefix('products')->name('products.')->group(function () {
            Route::get('register', [ProductController::class, 'create'])->name('register');
            Route::post('register', [ProductController::class, 'store'])->name('register');

            Route::post('/upload-temp-image', [UploadController::class, 'uploadTempImage'])
                ->name('upload.temp.image');




            // =====================
// Product / Card routes
// =====================
            Route::get('/', [CardsController::class, 'index'])->name('index');

            // Purchase creation (moved to PurchasesController)
            Route::get('/create', [PurchasesController::class, 'create'])->name('create');
            Route::post('/store', [PurchasesController::class, 'store'])->name('store');

            // Lookup endpoint
            Route::get('/lookup', [CardsController::class, 'lookup'])->name('lookup');

            // Assignment
            Route::get('/assign', [CardAssignmentController::class, 'showAssignPage'])->name('assign');
            Route::post('/assign', [CardAssignmentController::class, 'assignCard'])->name('assign');

            // Edit/update/delete card
            Route::get('/{id}/edit', [CardsController::class, 'edit'])->name('edit');
            Route::put('/{id}', [CardsController::class, 'update'])->name('update');
            Route::delete('/{id}', [CardsController::class, 'destroy'])->name('destroy');

            Route::get('/requests', [CustomerController::class, 'customerRequests'])->name('requests');
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
        Route::get('/api/latest-gold-rate', function () {
            $latestRate = \App\Models\GoldRate::latest()->value('rate');
            return response()->json(['rate' => $latestRate]);
        });
        Route::get('/api/latest-diamond-rate', function () {
            $latestRate = \App\Models\DiamondRate::latest()->value('rate');
            return response()->json(['rate' => $latestRate ?? 0]);
        });


        Route::resource('staff', StaffController::class);


        // // Logs and requests
        // Route::get('/logs', [DashboardController::class, 'logs'])->name('logs');
        // Route::get('/requests', [DashboardController::class, 'requests'])->name('requests');

        // Merchant requests viewing
        Route::get('/merchants/requests', [MerchantRequestController::class, 'index'])->name('merchants.request');

        // Merchant management
        Route::middleware('can:edit-merchants')->prefix('merchants')->name('merchants.')->group(function () {
            Route::get('/', [MerchantController::class, 'index'])->name('index');
            Route::get('/create', [MerchantController::class, 'create'])->name('create');
            Route::post('/store', [MerchantController::class, 'store'])->name('store');

            Route::get('/{id}/edit', [MerchantController::class, 'edit'])->name('edit');
            Route::put('/{id}', [MerchantController::class, 'update'])->name('update');
            Route::delete('/{id}', [MerchantController::class, 'destroy'])->name('destroy');

        });
        Route::get('/api/dropdown/{type}', [DropdownController::class, 'fetch'])->name('dropdown.fetch');
        Route::get('/api/dropdown/combined', [DropdownController::class, 'combined'])->name('dropdown.combined');
        Route::get('/card/{id}', [CardController::class, 'show'])->name('card.show');

        Route::get('/generate-qr/{data}', function ($data) {
            return QrCode::format('svg')->size(200)->generate($data);
        });

    });

    // ================================
    // Merchant-only routes (Customer Management)
    // ================================
    Route::middleware('role:merchant')->prefix('merchant')->name('merchant.')->group(function () {

        // Customers management
        Route::prefix('customers')->name('customers.')->group(function () {
            Route::get('/', [CustomerController::class, 'customers'])->name('index');
            Route::get('/create', [CustomerController::class, 'createCustomer'])->name('create');
            Route::post('/', [CustomerController::class, 'storeCustomer'])->name('store');
        });
        Route::prefix('cards')->name('cards.')->group(function () {
            // 🟣 View all assigned diamond certificates
            Route::get('/', [MerchantController::class, 'viewCards'])->name('index');

            // 🟢 Show assign-cards page (form + table)
            Route::get('/assign', [CustomerController::class, 'assignCardsPage'])->name('assign');

            // 🟠 Handle card assignment form submission
            Route::post('/assign', [CustomerController::class, 'assignCard'])->name('assign');
        });
        Route::prefix('marketplace')->name('marketplace.')->group(function () {
            // Route::get('/card-requests', [MerchantController::class, 'viewRequests'])->name('cards.requests');
            Route::get('/request', [MerchantController::class, 'requestCards'])->name('request');

            // View Requests page
            Route::get('/view', [MerchantController::class, 'viewRequests'])->name('view');
        });

        // Requests management
        Route::get('/requests', [MerchantRequestController::class, 'merchantRequests'])->name('merchant.requests');
        Route::post('/requests', [MerchantRequestController::class, 'storeRequest'])->name('merchant.requests.store');
        Route::delete('/unassign-card/{id}', [MerchantController::class, 'unassignCard'])->name('unassignCard');

    });



});

require __DIR__ . '/auth.php';
