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
        return TempPurchaseItem::where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();
    }

    // Store one item
    public function store(Request $request)
    {
        // Validate incoming fields (all from modal)
        $request->validate([
            'product_code'       => 'required|string',
            'item_code'          => 'nullable|string',
            'item_name'          => 'nullable|string',
            'quantity'           => 'nullable|numeric',
            'gold_rate'          => 'nullable|numeric',
            'gross_weight'       => 'nullable|numeric',
            'stone_weight'       => 'nullable|numeric',
            'diamond_weight'     => 'nullable|numeric',
            'net_weight'         => 'nullable|numeric',
            'stone_amount'       => 'nullable|numeric',
            'diamond_rate'       => 'nullable|numeric',
            'making_charge'      => 'nullable|numeric',
            'card_charge'        => 'nullable|numeric',
            'other_charge'       => 'nullable|numeric',
            'total_amount'       => 'nullable|numeric',
            'landing_cost'       => 'nullable|numeric',
            'retail_percent'     => 'nullable|numeric',
            'retail_cost'        => 'nullable|numeric',
            'mrp_percent'        => 'nullable|numeric',
            'mrp_cost'           => 'nullable|numeric',

            // Diamond certificate fields
            'certificate_id'     => 'nullable|string',
            'color'              => 'nullable|string',
            'clarity'            => 'nullable|string',
            'cut'                => 'nullable|string',

            // Uploaded image paths (from AJAX temp upload)
            'certificate_image'  => 'nullable|string',
            'product_image'      => 'nullable|string',

            'barcode_data'       => 'nullable|string',
            'notes'              => 'nullable|string',
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
            'item_name'    => $request->item_name,
            'quantity'     => $request->quantity,
            'net_weight'   => $request->net_weight,
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
