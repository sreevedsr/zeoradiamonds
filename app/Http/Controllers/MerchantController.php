<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MerchantController extends Controller
{
    public function index()
    {
        // List all merchants
        $merchants = User::where('role', 'merchant')->get();
        return view('admin.merchants.index', compact('merchants'));
    }

    public function create()
    {
        // Show form to add merchant
        return view('admin.merchants.create');
    }

    public function store(Request $request)
{
    // Validate input
    $request->validate([
        'name' => 'required|string|max:255',
        'owner_name' => 'required|string|max:255',
        'business_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|string|max:20',
        'address' => 'required|string|max:500',
    ]);

    // Create merchant
    User::create([
        'name' => $request->name,
        'business_name' => $request->business_name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'role' => 'merchant',
        'password' => Hash::make('merchant123'), // default or remove if nullable
    ]);

    return redirect()->route('admin.merchants.index')->with('success', 'Merchant added successfully.');
}


    public function assignCardsPage()
{
    // Fetch merchants, customers, and available cards if needed
    // $customers = \App\Models\Customer::all();
    // $cards = \App\Models\Card::all();

    // Return your assign-cards view (create this if not existing)
    return view('merchant.cards.assign');
}
public function viewCards()
{
    // Fetch cards from database if needed
    // Example:
    // $cards = Card::all();

    // Return the view
    return view('merchant.cards.index');
}
public function requestCards()
    {
        return view('merchant.cards.request-card');
    }

    public function viewRequests()
    {
        return view('merchant.cards.view-requests');
    }
}

