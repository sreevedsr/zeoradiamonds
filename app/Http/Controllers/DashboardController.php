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
        $role = $user->role;

        // // Load any shared or role-specific data here
        // $cards = ($role === 'superadmin')
        //     ? \App\Models\DigitalCard::all()
        //     : \App\Models\DigitalCard::where('created_by', $user->id)->get();

        // $requests = ($role === 'superadmin')
        //     ? \App\Models\ProductRequest::all()
        //     : \App\Models\ProductRequest::where('merchant_id', $user->id)->get();

        // $logs = ($role === 'superadmin')
        //     ? \App\Models\ActivityLog::all()
        //     : null;
// , 'cards', 'requests', 'logs'
        return view('dashboard.main', compact('user', 'role'));
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

    /**
     * Merchant-only: view buyers.
     */
    public function buyers()
    {
        return view('dashboard.buyers'); // Blade: resources/views/dashboard/buyers.blade.php
    }

    /**
     * Merchant-only: show create buyer form.
     */
    public function createBuyer()
    {
        return view('dashboard.buyers-create'); // Blade
    }

    /**
     * Merchant-only: store new buyer.
     */
    public function storeBuyer(Request $request)
    {
        // Your buyer storing logic
        return redirect()->route('buyers');
    }

    /**
     * Merchant-only: assign card to buyers.
     */
    public function assignCard()
    {
        return view('dashboard.assign-card'); // Blade
    }

    /**
     * Merchant-only: store card assignment.
     */
    public function storeAssignment(Request $request)
    {
        // Logic to assign card
        return redirect()->route('cards.assign');
    }

    /**
     * Merchant-only: view requests.
     */
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
    public function customers()
    {
        // Example: fetch customers from DB
        $customers = []; // Replace with Customer::all();
        return view('merchant.customers.index', compact('customers'));
    }

    // Show form to add a new customer
    public function createCustomer()
    {
        return view('merchant.customers.create');
    }

    // Store new customer
    public function storeCustomer(Request $request)
    {
        // Validate and save customer
        // Customer::create($request->all());
        return redirect()->route('customers.index')->with('success', 'Customer added successfully!');
    }

    // View customer requests
    public function customerRequests()
    {
        $requests = []; // Replace with actual requests from DB
        return view('admin.cards.requests', compact('requests'));
    }
}
