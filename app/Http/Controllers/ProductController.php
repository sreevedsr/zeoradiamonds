<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show the product registration form
    public function create()
    {
        $lastProduct = Product::latest('id')->first();
        $nextSerialNo = $lastProduct ? $lastProduct->id + 1 : 1;

        return view('admin.cards.product', compact('nextSerialNo'));
    }

    // Store product data
    public function store(Request $request)
    {
        $validated = $request->validate([
            'hsn_code' => 'nullable|string|max:255',
            'item_code' => 'required|string|max:255|unique:products,item_code',
            'item_name' => 'required|string|max:255',
        ]);

        Product::create($validated);

        return redirect()->back()->with('success', 'Product saved successfully!');
    }

    // View all products (optional)
    public function index()
    {
        $products = Product::all();

        return view('admin.cards.product-list', compact('products'));
    }
}
