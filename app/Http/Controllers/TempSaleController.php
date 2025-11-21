<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TempSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TempSaleController extends Controller
{

    // list items for the current session/user (or for a merchant)
    public function index(Request $request)
    {
        // Only fetch current user's temp sales (adjust auth rule as needed)
        $items = TempSale::with('card')
            ->where('created_by', auth()->id())
            ->get();

        // Optional: transform if you want to remove sensitive fields
        $payload = $items->map(function ($t) {
            return [
                'id' => $t->id,
                'card_id' => $t->card_id,
                'quantity' => $t->quantity,
                'net_weight' => $t->net_weight,
                'net_amount' => $t->net_amount,
                'total_amount' => $t->total_amount,
                // include whole card object for expanded view
                'card' => $t->card ? $t->card->toArray() : null,
            ];
        });

        return response()->json(['items' => $payload]);
    }

    // store one item into temp_sales
    public function store(Request $request)
    {
        // dd($request->input('product_code'));

        $request->validate([
            'product_code' => 'required|string|exists:cards,product_code',
        ]);

        $cardId = \App\Models\Card::where('product_code', $request->product_code)->value('id');

        // Safety check
        if (!$cardId) {
            return response()->json(['error' => 'Card not found for this product code'], 422);
        }
        if (
            TempSale::where('product_code', $request->product_code)
                ->where('created_by', auth()->id())
                ->exists()
        ) {
            return response()->json(['duplicate' => true]);
        }



        $temp = TempSale::create([
            'product_code' => $request->product_code,
            'card_id' => $cardId,
            'created_by' => auth()->id(),
        ]);

        return response()->json(['success' => true, 'temp_sale' => $temp]);
    }



    // delete a temp sale item
    public function destroy(TempSale $tempSale)
    {
        // authorize (optional)
        if ($tempSale->created_by !== auth()->id()) {
            abort(403);
        }

        $tempSale->delete();

        return response()->json(['success' => true]);
    }
}
