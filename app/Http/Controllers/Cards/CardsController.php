<?php

namespace App\Http\Controllers\Cards;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $cards = Card::with('merchant')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('certificate_id', 'like', "%{$search}%")
                        ->orWhere('item_name', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.purchases.index', compact('cards'));
    }

    public function lookup(Request $request)
    {
        $search = $request->get('q');

        $products = \DB::table('cards')
            ->leftJoin('products', 'cards.item_code', 'products.item_code')
            ->select('cards.*', 'products.hsn_code')
            ->when($search, function ($q) use ($search) {
                $q->where('cards.product_code', 'like', "%{$search}%")
                  ->orWhere('cards.item_name', 'like', "%{$search}%");
            })
            ->limit(25)
            ->get();

        return response()->json($products);
    }

    public function edit($id)
    {
        $card = Card::findOrFail($id);
        return view('admin.cards.edit', compact('card'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $validated = $request->validate([
            'product_code' => 'required|string|max:255',
            'item_code' => 'required|string|max:255',
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:1',
            'certificate_id' => 'required|string|max:255',
        ]);

        $card = Card::findOrFail($id);
        $card->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Card updated.');
    }

    public function destroy($id)
    {
        $card = Card::findOrFail($id);
        $card->delete();

        return back()->with('success', 'Card deleted.');
    }
}
