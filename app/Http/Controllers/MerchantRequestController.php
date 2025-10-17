<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MerchantRequest;
use App\Models\Card; // Assuming you have a Card model
use Illuminate\Support\Facades\Auth;

class MerchantRequestController extends Controller
{
    // Show all requests for cards posted by the current admin
    public function index()
    {
        // $adminId = Auth::id(); // currently logged-in admin

        // // Fetch all requests for cards that this admin has posted
        // $requests = MerchantRequest::with('merchant', 'card')
        //     ->whereHas('card', function ($query) use ($adminId) {
        //         $query->where('admin_id', $adminId);
        //     })
        //     ->get();
        // , compact('requests')

        return view('merchants.requests');
    }
}
