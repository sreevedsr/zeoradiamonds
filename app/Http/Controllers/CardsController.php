<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardsController extends Controller
{
    public function index()
    {
        // Only admins can access this page
        if (!Auth::user() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        return view('cards.index');
    }

    public function store(Request $request)
    {
        // Only admins can add card details
        if (!Auth::user() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        // Example: store card details (you can expand this later)
        // Card::create($request->all());

        return back()->with('success', 'Card added successfully!');
    }
}
