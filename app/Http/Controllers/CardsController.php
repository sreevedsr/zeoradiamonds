<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class CardsController extends Controller
{
    public function index()
    {
        // Only admins can access this page
        if (!Auth::user() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        return view('admin.cards.index');
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
    public function assignView()
    {
        $merchants = User::where('role', 'merchant')->get();
        $cards = DiamondCard::whereNull('merchant_id')->get();

        return view('admin.cards.assign', compact('merchants', 'cards'));
    }

    public function assignNew(Request $request)
    {
        $request->validate([
            'merchant_id' => 'required|exists:users,id',
            'card_number' => 'required|unique:diamond_cards,card_number',
            'carat_weight' => 'required|numeric',
            'clarity' => 'required',
            'color' => 'required',
            'cut' => 'required',
        ]);

        DiamondCard::create([
            'merchant_id' => $request->merchant_id,
            'card_number' => $request->card_number,
            'carat_weight' => $request->carat_weight,
            'clarity' => $request->clarity,
            'color' => $request->color,
            'cut' => $request->cut,
            'assigned_by' => auth()->id(),
        ]);

        return back()->with('success', 'Card assigned successfully.');
    }

    public function assignExisting()
    {
        // $request->validate(['merchant_id' => 'required|exists:users,id']);

        // $card = DiamondCard::findOrFail($id);
        // $card->update(['merchant_id' => $request->merchant_id]);

        // return back()->with('success', 'Existing card assigned successfully.');
        return view('admin.cards.assign');
    }

}
