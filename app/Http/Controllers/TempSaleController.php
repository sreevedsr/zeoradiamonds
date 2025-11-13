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
        $data = $request->only([
            'card_id',
            'barcode',
            'product_code',
            'item_code',
            'item_name',
            'hsn',
            'quantity',
            'gross_weight',
            'stone_weight',
            'diamond_weight',
            'net_weight',
            'net_amount',
            'cgst',
            'sgst',
            'igst',
            'total_amount',
        ]);

        $validator = Validator::make($data, [
            'card_id' => 'nullable|integer|exists:cards,id',
            // 'merchant_id' => 'required|integer|exists:users,id',
            'quantity' => 'required|numeric|min:0.01',
            'net_amount' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'product_code' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data['created_by'] = Auth::id();

        $temp = TempSale::create($data);

        // broadcast or return the created resource
        return response()->json([
            'success' => true,
            'temp_sale' => $temp
        ]);
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
