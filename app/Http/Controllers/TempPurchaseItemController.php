<?php

namespace App\Http\Controllers;

use App\Models\TempPurchaseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TempPurchaseItemController extends Controller
{
    // Fetch items for logged-in user
    public function index()
    {
        return TempPurchaseItem::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
    }

    // Store one item
    public function store(Request $request)
    {
        $request->validate([
            'product_code' => 'required|string',
        ]);

        $productCode = $request->product_code;

        // Check duplicate in temp items (current user)
        $existsInTemp = TempPurchaseItem::where('user_id', Auth::id())
            ->where('product_code', $productCode)
            ->exists();

        // Check duplicate in cards table (global)
        $existsInCards = \App\Models\Card::where('product_code', $productCode)->exists();

        if ($existsInTemp || $existsInCards) {
            return response()->json([
                'error' => 'Product code already exists.'
            ], 422);
        }

        // Store item
        $data = $request->all();
        $data['user_id'] = Auth::id();

        TempPurchaseItem::create($data);

        return response()->json(['status' => 'success']);
    }



    public function update(Request $request, $id)
    {
        $item = TempPurchaseItem::findOrFail($id);

        $item->update([
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
            'net_weight' => $request->net_weight,
            'total_amount' => $request->total_amount,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Item updated successfully'
        ]);
    }

    // Delete a single item
    public function destroy($id)
    {
        TempPurchaseItem::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return response()->json(['status' => 'deleted']);
    }

    // Clear all items for the user
    public function clearAll()
    {
        TempPurchaseItem::where('user_id', Auth::id())->delete();

        return response()->json(['status' => 'cleared']);
    }
}
