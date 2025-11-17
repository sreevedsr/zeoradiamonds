<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
        public function createCustomer()
    {
        return view('merchant.customers.create');
    }

    // Store new customer


    // View customer requests
    public function customerRequests()
    {
        // $requests = []; // Replace with actual requests from DB
        return view('admin.cards.requests');
    }
}
