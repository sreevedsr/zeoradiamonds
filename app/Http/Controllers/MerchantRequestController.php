<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MerchantRequest;
use App\Models\Card; // Assuming you have a Card model
use Illuminate\Support\Facades\Auth;

class MerchantRequestController extends Controller
{
    public function requests()
    {
        return view('admin.cards.requests'); // Blade
    }
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
}
