<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TempSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TempSaleController extends Controller
{


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

        $temp = TempSale::create([
            'product_code' => $request->product_code,
            'card_id' => $cardId,
            'created_by' => auth()->id(),
        ]);

        return response()->json(['success' => true, 'temp_sale' => $temp]);
    }


    // list items for the current session/user (or for a merchant)
    public function index(Request $request)
    {
        $query = TempSale::query();

        // optional: filter for the current user
        if ($request->user()) {
            $query->where('created_by', $request->user()->id);
        }

        $items = $query->orderBy('created_at')->get();

        return response()->json(['items' => $items]);
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
