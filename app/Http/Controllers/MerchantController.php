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
}
