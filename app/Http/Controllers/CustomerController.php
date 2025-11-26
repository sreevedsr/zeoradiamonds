<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    //     public function createCustomer()
    // {
    //     return view('merchant.customers.create');
    // }

    // // Store new customer


    // // View customer requests
    // public function customerRequests()
    // {
    //     // $requests = []; // Replace with actual requests from DB
    //     return view('admin.cards.requests');
    // }
    public function customers(Request $request)
    {
        $search = $request->input('search');

        $query = Customer::where('merchant_id', Auth::id());

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('state', 'like', "%{$search}%");
            });
        }

        $customers = $query->orderBy('created_at', 'desc')->paginate(25);

        // // Handle AJAX search request
        // if ($request->ajax()) {
        //     return view('merchant.customers.partials.table', compact('customers'))->render();
        // }

        return view('merchant.customers.index', compact('customers'));
    }

    public function storeCustomer(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:20',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
        ]);

        // Add the logged-in merchant's ID
        $validated['merchant_id'] = Auth::id();

        Customer::create($validated);

        return redirect()
            ->route('merchant.customers.index')
            ->with('success', 'Customer added successfully!');
    }

    public function assignCard(Request $request)
    {
        $validated = $request->validate([
            'customer' => 'required|exists:customers,id',
            'card_id' => 'required|exists:cards,id',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
        ]);

        $card = Card::findOrFail($validated['card_id']);

        // Assign the card to the selected customer
        $card->customer_id = $validated['customer'];
        $card->price = $validated['price'];
        $card->discount = $validated['discount'] ?? 0;
        $card->final_price = $validated['price'] - (($validated['discount'] ?? 0) / 100 * $validated['price']);
        $card->save();

        return redirect()
            ->back()
            ->with('success', 'Certificate assigned successfully!');
    }


    public function assignCardsPage()
    {
        $merchant = Auth::user(); // get logged-in merchant

        $customers = Customer::all();
        $cards = Card::where('merchant_id', $merchant->id)->get(['id', 'certificate_id', 'valuation']); // only this merchant’s cards

        return view('merchant.cards.assign', compact('customers', 'cards'));
    }

}
