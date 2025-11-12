<?php

namespace App\Http\Controllers;

use App\Models\TempPurchaseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TempPurchaseController extends Controller
{
    public function index()
    {
        $items = TempPurchaseItem::where('user_id', Auth::id())->get();
        return view('admin.purchases.create', compact('items'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'gold_rate' => 'nullable|numeric|min:0',
            'total_amount' => 'nullable|numeric|min:0',
        ]);

        TempPurchaseItem::create([
            'user_id' => Auth::id(),
            ...$validated,
        ]);

        return redirect()->back()->with('success', 'Item added successfully!');
    }

    public function remove($id)
    {
        TempPurchaseItem::where('user_id', Auth::id())->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Item removed!');
    }

    public function clear()
    {
        TempPurchaseItem::where('user_id', Auth::id())->delete();
        return redirect()->back()->with('success', 'All items cleared.');
    }
}
