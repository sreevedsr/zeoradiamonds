<?php

namespace App\Http\Controllers;

use App\Models\StateCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $total = User::where('role', 'merchant')->count();

        $perPage = 10;
        $page = request('page', 1);

        $merchants = User::where('role', 'merchant')
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        return view('admin.merchants.index', [
            'merchants' => $merchants,
            'pagination' => [
                'from' => ($page - 1) * $perPage + 1,
                'to' => min($page * $perPage, $total),
                'total' => $total,
                'pages' => range(1, ceil($total / $perPage)),
                'current' => $page,
            ],
        ]);
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
