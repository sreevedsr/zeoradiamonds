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
        $search = $request->search;
        $supplierId = $request->supplier_id;
        $from = $request->from;
        $to = $request->to;

        // Base query
        $query = Card::with(['merchant', 'purchaseInvoice']);

        // Apply search filter
// Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('certificate_id', 'like', "%{$search}%")
                    ->orWhere('product_code', 'like', "%{$search}%")
                    ->orWhereHas('product', function ($p) use ($search) {
                        $p->where('item_name', 'like', "%{$search}%");
                    });
            });
        }


        // Apply supplier filter
        if ($supplierId) {
            $query->whereHas('purchaseInvoice', function ($p) use ($supplierId) {
                $p->where('supplier_id', $supplierId);
            });
        }

        // Apply date range
        if ($from) {
            $query->whereHas('purchaseInvoice', function ($q) use ($from) {
                $q->whereDate('invoice_date', '>=', $from);
            });
        }

        if ($to) {
            $query->whereHas('purchaseInvoice', function ($q) use ($to) {
                $q->whereDate('invoice_date', '<=', $to);
            });
        }


        // -------------------------
        // 🎉 Show success message
        // -------------------------
        if ($search || $supplierId || $from || $to) {
            session()->flash('success', 'Filters applied successfully.');
        }

        // Final results
        $cards = $query->orderByDesc('created_at')->paginate(25)->withQueryString();

        $suppliers = \App\Models\Supplier::select('id', 'name')->orderBy('name')->get();

        return view('admin.reports.purchase', compact('cards', 'suppliers'));
    }

    public function lookup(Request $request)
    {
        $search = $request->get('q');
        $user = Auth::user();

        $query = \DB::table('cards')
            ->leftJoin('products', 'cards.item_code', 'products.item_code')
            ->join('card_ownerships', 'cards.id', '=', 'card_ownerships.card_id')
            ->select('cards.*', 'products.hsn_code');

        // -----------------------------
        //  OWNERSHIP FILTER
        // -----------------------------
        if ($user->role === 'admin') {

            // Admin should ONLY see admin-owned cards
            $query->where('card_ownerships.owner_type', 'admin');

        } else if ($user->role === 'merchant') {

            // Merchant should only see THEIR cards
            $query->where('card_ownerships.owner_type', 'merchant')
                ->where('card_ownerships.owner_id', $user->id);
        }

        // -----------------------------
        //  SEARCH FILTER 
        // -----------------------------
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('cards.product_code', 'like', "%{$search}%")
                    ->orWhere('products.item_name', 'like', "%{$search}%")
                    ->orWhere('products.item_code', 'like', "%{$search}%");
            });
        }


        $products = $query->limit(25)->get();

        return response()->json($products);
    }

    public function edit($id)
    {
        $card = Card::findOrFail($id);
        return view('admin.cards.edit', compact('card'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin')
            abort(403);

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
