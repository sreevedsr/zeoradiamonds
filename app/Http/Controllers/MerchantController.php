<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StateCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class MerchantController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'merchant');

        if ($request->has('search') && $request->search !== '') {
            $query->where(function ($q) use ($request) {
                $q->where('merchant_code', 'like', '%' . $request->search . '%')
                    ->orWhere('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        $merchants = $query->paginate(25)->withQueryString();

        return view('admin.merchants.index', compact('merchants'));
    }


    public function create()
    {
        $stateCodes = StateCode::all(['state_code', 'state_name', 'gstin_code']);

        return view('admin.merchants.create', compact('stateCodes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'merchant_code' => 'required|string|max:50|unique:users,merchant_code',
            'merchant_name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'state_code' => 'required|string|max:10',
            'state' => 'required|string|max:100',
            'gst_no' => 'required|string|max:20|unique:users,gst_no',
        ]);

        User::create([
            'merchant_code' => $request->merchant_code,
            'name' => $request->merchant_name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'state_code' => $request->state_code,
            'state' => $request->state,
            'gst_no' => $request->gst_no,
            'role' => 'merchant',
            'password' => Hash::make('merchant123'),
        ]);

        return redirect()->route('admin.merchants.index')->with('success', 'Merchant registered successfully.');
    }

    // Update merchant details
    public function update(Request $request, $id)
    {
        $merchant = User::findOrFail($id);

        $request->validate([
            'merchant_code' => 'required|string|max:100|unique:users,merchant_code,' . $merchant->id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $merchant->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'state_code' => 'required|string|max:10',
            'state' => 'required|string|max:100',
            'gst_no' => 'nullable|string|max:30',
        ]);

        $merchant->update($request->only([
            'merchant_code',
            'name',
            'email',
            'phone',
            'address',
            'state_code',
            'state',
            'gst_no',
        ]));

        return redirect()->route('admin.merchants.index')->with('success', 'Merchant updated successfully.');
    }


    public function destroy($id)
    {
        $merchant = User::findOrFail($id);
        $merchant->delete();

        return redirect()->route('admin.merchants.index')->with('success', 'Merchant deleted successfully!');
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
