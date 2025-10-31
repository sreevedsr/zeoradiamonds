<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the main dashboard for admin or merchant.
     */
    public function index()
    {
        $user = Auth::user();

        // ---------------------------
        // Dummy data (hardcoded)
        // ---------------------------
        // Overall vendor/admin data
        $vendorData = [
            'total_clients' => 152,
            'sales_this_month' => 245000,   // in INR
            'sales_last_month' => 210000,
            'new_customers_this_month' => 12,
            'new_customers_last_month' => 9,
            'top_customers' => [
                ['name' => 'Kumar Jewellers', 'orders' => 8, 'amount' => 78000],
                ['name' => 'Radiant Gems', 'orders' => 5, 'amount' => 42000],
                ['name' => 'S & Sons', 'orders' => 3, 'amount' => 29000],
            ],
            // last 6 months sales for chart
            'monthly_sales' => [
                ['label' => 'May', 'value' => 160000],
                ['label' => 'Jun', 'value' => 175000],
                ['label' => 'Jul', 'value' => 190000],
                ['label' => 'Aug', 'value' => 205000],
                ['label' => 'Sep', 'value' => 210000],
                ['label' => 'Oct', 'value' => 245000],
            ],
        ];

        // Merchant-specific sample (only their own)
        $merchantData = [
            'total_clients' => 38,
            'sales_this_month' => 82000,
            'sales_last_month' => 73000,
            'new_customers_this_month' => 4,
            'new_customers_last_month' => 3,
            'top_customers' => [
                ['name' => 'Local Buyer A', 'orders' => 2, 'amount' => 22000],
                ['name' => 'Local Buyer B', 'orders' => 1, 'amount' => 18000],
            ],
            'monthly_sales' => [
                ['label' => 'May', 'value' => 45000],
                ['label' => 'Jun', 'value' => 48000],
                ['label' => 'Jul', 'value' => 51000],
                ['label' => 'Aug', 'value' => 56000],
                ['label' => 'Sep', 'value' => 73000],
                ['label' => 'Oct', 'value' => 82000],
            ],
        ];

        // pick which dataset to show
        if ($user->role === 'vendor' || $user->role === 'admin') {
            $data = $this->prepareMetrics($vendorData);
            $scope = 'vendor';
        } else {
            // merchant
            $data = $this->prepareMetrics($merchantData);
            $scope = 'merchant';
        }

        return view('dashboard.main', [
            'user' => $user,
            'scope' => $scope,
            'metrics' => $data,
        ]);
    }

    /**
     * Prepare metrics (calculate diffs, percent etc).
     */
    private function prepareMetrics(array $src)
    {
        $salesThis = $src['sales_this_month'];
        $salesLast = $src['sales_last_month'];

        $sales_diff = $salesThis - $salesLast;
        $sales_diff_percent = $salesLast > 0 ? ($sales_diff / $salesLast) * 100 : null;

        $newCustThis = $src['new_customers_this_month'];
        $newCustLast = $src['new_customers_last_month'];
        $newCust_diff = $newCustThis - $newCustLast;
        $newCust_diff_percent = $newCustLast > 0 ? ($newCust_diff / $newCustLast) * 100 : null;

        return array_merge($src, [
            'sales_diff' => $sales_diff,
            'sales_diff_percent' => $sales_diff_percent,
            'new_customers_diff' => $newCust_diff,
            'new_customers_diff_percent' => $newCust_diff_percent,
        ]);
    }


    /**
     * Admin-only: view cards.
     */
    public function cards()
    {
        return view('dashboard.cards'); // Blade: resources/views/dashboard/cards.blade.php
    }

    /**
     * Admin-only: show create card form.
     */
    public function createCard()
    {
        return view('admin.cards.create'); // Blade
    }

    /**
     * Admin-only: store new card.
     */
    public function storeCard(Request $request)
    {
        // Your card storing logic
        return redirect()->route('admin.cards');
    }

    /**
     * Admin-only: view logs.
     */
    public function logs()
    {
        return view('dashboard.logs'); // Blade
    }

    /**
     * Admin-only: view requests.
     */
    public function requests()
    {
        return view('admin.cards.requests'); // Blade
    }

    public function merchantRequests()
    {
        return view('dashboard.merchant-requests'); // Blade
    }

    /**
     * Merchant-only: store new request.
     */
    public function storeRequest(Request $request)
    {
        // Logic to store merchant request
        return redirect()->route('merchant.requests');
    }


    // Show form to add a new customer
    public function createCustomer()
    {
        return view('merchant.customers.create');
    }

    // Store new customer


    // View customer requests
    public function customerRequests()
    {
        // $requests = []; // Replace with actual requests from DB
        return view('admin.cards.requests');
    }
}
