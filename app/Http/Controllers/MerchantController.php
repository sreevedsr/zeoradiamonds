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
        return view('merchants.index', compact('merchants'));
    }

    public function create()
    {
        // Show form to add merchant
        return view('merchants.create');
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // requires password_confirmation field
        ]);

        // Create merchant
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'merchant',
        ]);

        return redirect()->route('merchants.index')->with('success', 'Merchant added successfully.');
    }
    public function assignCardsPage()
{
    // Fetch merchants, customers, and available cards if needed
    // $customers = \App\Models\Customer::all();
    // $cards = \App\Models\Card::all();

    // Return your assign-cards view (create this if not existing)
    return view('cards.merchants.assign');
}
public function viewCards()
{
    // Fetch cards from database if needed
    // Example:
    // $cards = Card::all();

    // Return the view
    return view('cards.merchants.index');
}
public function requestCards()
    {
        return view('merchants.request-cards'); // Make sure this blade exists
    }

    // Show View Requests page
    public function viewRequests()
    {
        return view('merchants.view-requests'); // Make sure this blade exists
    }
}
