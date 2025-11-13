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
        $data = $request->all();
        $data['user_id'] = Auth::id();

        TempPurchaseItem::create($data);

        return response()->json(['status' => 'success']);
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
