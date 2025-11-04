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
        $perPage = 10; // Number of merchants per page
        $page = request()->get('page', 1); // Get current page number

        // Query total merchants and paginated data
        $total = User::where('role', 'merchant')->count();

        $merchants = User::where('role', 'merchant')
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        // Calculate range for display
        $from = ($page - 1) * $perPage + 1;
        $to = min($from + $perPage - 1, $total);
        $totalPages = ceil($total / $perPage);

        $pages = range(1, $totalPages);

        // Send merchants and pagination data to view
        return view('admin.merchants.index', [
            'merchants' => $merchants,
            'pagination' => [
                'from' => $from,
                'to' => $to,
                'total' => $total,
                'pages' => $pages,
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
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'state_code' => 'required|string|max:10',
            'state' => 'required|string|max:100',
            'gst_no' => 'required|string|max:20|unique:users,gst_no',
        ]);

        User::create([
            'merchant_code' => $request->merchant_code,
            'name' => $request->merchant_name,
            'email' => $request ->email,
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
            'name' => 'required|string|max:255',
            'business_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$merchant->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        $merchant->update($request->only(['name', 'business_name', 'email', 'phone', 'address']));

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
