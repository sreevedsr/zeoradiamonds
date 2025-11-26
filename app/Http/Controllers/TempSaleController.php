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
        $items = TempSale::query()
            ->join('cards', 'temp_sales.card_id', '=', 'cards.id')
            ->join('products', 'cards.item_code', '=', 'products.item_code')
            ->where('temp_sales.created_by', auth()->id())
            ->select([
                'temp_sales.id',

                // From cards table
                'cards.product_code',
                'cards.net_weight',
                'cards.total_amount as net_amount',
                'temp_sales.amount as total_amount',

                // From products table
                'products.item_name',
                'products.hsn_code',
            ])
            ->orderBy('temp_sales.id')
            ->get();

        return response()->json([
            'items' => $items
        ]);
    }




    // store one item into temp_sales
    public function store(Request $request)
    {
        $request->validate([
            'product_code' => 'required|string|exists:cards,product_code',
            'amount' => 'required|numeric|min:0',
        ]);

        $card = \App\Models\Card::where('product_code', $request->product_code)->first();

        if (!$card) {
            return response()->json(['error' => 'Card not found'], 404);
        }

        // Fetch related product using item_code
        $product = \App\Models\Product::where('item_code', $card->item_code)->first();

        if (!$product) {
            return response()->json(['error' => 'Related product not found'], 404);
        }

        // Prevent duplicates for this user
        if (
            TempSale::where('product_code', $request->product_code)
                ->where('created_by', auth()->id())
                ->exists()
        ) {
            return response()->json(['duplicate' => true]);
        }

        $temp = TempSale::create([
            'product_code' => $card->product_code,
            'card_id' => $card->id,
            'created_by' => auth()->id(),
            'amount' => $request->amount,
        ]);

        // Return flattened data exactly like index()
        return response()->json([
            'id' => $temp->id,

            // cards fields
            'product_code' => $card->product_code,
            'net_weight' => $card->net_weight,
            'net_amount' => $card->total_amount,
            'total_amount' => $temp->amount,

            // products fields
            'item_name' => $product->item_name,
            'hsn_code' => $product->hsn_code,
        ]);
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
