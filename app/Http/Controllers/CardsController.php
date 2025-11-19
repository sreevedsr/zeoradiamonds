<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\PurchaseInvoice;
use App\Models\Staff;
use App\Models\GoldRate;
use App\Models\Supplier;
use App\Models\TempSale;
use Illuminate\Http\Request;
use App\Models\TempPurchaseItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use App\Models\CardOwnership;
use App\Models\CardOwnershipHistory;

class CardsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $cards = Card::with('merchant')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('certificate_id', 'like', "%{$search}%")
                        ->orWhere('diamond_purchase_location', 'like', "%{$search}%")
                        ->orWhere('carat_weight', 'like', "%{$search}%")
                        ->orWhere('clarity', 'like', "%{$search}%")
                        ->orWhere('color', 'like', "%{$search}%")
                        ->orWhere('cut', 'like', "%{$search}%")
                        ->orWhereHas('merchant', function ($m) use ($search) {
                            $m->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        $merchants = User::where('role', 'merchant')->orderBy('name')->get();

        return view('admin.cards.index', compact('cards', 'merchants'));
    }

    public function createCard()
    {
        $suppliers = Supplier::orderBy('name')->get();
        $staff = Staff::orderBy('name')->get();

        $lastInvoice = PurchaseInvoice::latest('id')->first();
        $nextInvoiceNo = 'INV-' . str_pad(($lastInvoice?->id ?? 0) + 1, 5, '0', STR_PAD_LEFT);
        $latestGoldRate = GoldRate::latest()->value('rate') ?? 0;


        return view('admin.purchases.create', compact('suppliers', 'staff', 'nextInvoiceNo', 'latestGoldRate'));
    }

    public function storeCard(Request $request)
    {
        // Restrict to admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        // Validate top-level invoice fields
        $validated = $request->validate([
            'invoice_no' => 'required|string|max:100|unique:purchase_invoices,invoice_no',
            'invoice_date' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        // Fetch temp items
        $tempItems = TempPurchaseItem::where('user_id', auth()->id())->get();

        if ($tempItems->isEmpty()) {
            return back()->withErrors(['items' => 'You must add at least one item before submitting the invoice.']);
        }

        // ----------------------------------------------------
        // 🔒 TRANSACTION STARTS HERE
        // ----------------------------------------------------
        try {
            DB::beginTransaction();

            // Create Invoice
            $invoice = PurchaseInvoice::create([
                'invoice_no' => $validated['invoice_no'],
                'invoice_date' => $validated['invoice_date'],
                'supplier_id' => $validated['supplier_id'],
            ]);

            foreach ($tempItems as $item) {

                $card = Card::create([
                    'purchase_invoice_id' => $invoice->id,
                    'product_code' => $item->product_code,
                    'item_code' => $item->item_code,
                    'item_name' => $item->item_name,
                    'quantity' => $item->quantity,
                    'gold_rate' => $item->gold_rate,
                    'gross_weight' => $item->gross_weight,
                    'stone_weight' => $item->stone_weight,
                    'diamond_weight' => $item->diamond_weight,
                    'net_weight' => $item->net_weight,
                    'stone_amount' => $item->stone_amount,
                    'diamond_rate' => $item->diamond_rate,
                    'making_charge' => $item->making_charge,
                    'card_charge' => $item->card_charge,
                    'other_charge' => $item->other_charge,
                    'total_amount' => $item->total_amount,
                    'landing_cost' => $item->landing_cost,
                    'retail_percent' => $item->retail_percent,
                    'retail_cost' => $item->retail_cost,
                    'mrp_percent' => $item->mrp_percent,
                    'mrp_cost' => $item->mrp_cost,
                    'certificate_id' => $item->certificate_id,
                    'color' => $item->color,
                    'clarity' => $item->clarity,
                    'cut' => $item->cut,
                    'certificate_code' => $item->certificate_code,
                    'certificate_image' => $item->certificate_image,
                    'product_image' => $item->product_image,
                ]);

                CardOwnership::create([
                    'card_id' => $card->id,
                    'owner_type' => 'admin',
                    'owner_id' => null,
                ]);
            }

            // Delete temp items only if everything succeeded
            TempPurchaseItem::where('user_id', auth()->id())->delete();

            DB::commit(); // ✅ All good: commit the transaction

        } catch (\Throwable $e) {

            DB::rollBack(); // ❌ Something failed: rollback everything

            return back()->withErrors([
                'error' => 'Failed to save invoice. Please try again.',
                'exception' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);
        }

        // Success Redirect
        return redirect()
            ->route('admin.products.create')
            ->with('success', "Invoice #{$invoice->invoice_no} saved and all product items added successfully.")
            ->with('clear_items', true);
    }


    public function update(Request $request, $id)
    {
        // ✅ Restrict to Admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        // ✅ Validate all updatable fields
        $validated = $request->validate([
            // Product Info
            'product_code' => 'required|string|max:255',
            'item_code' => 'required|string|max:255',
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:1',
            'gold_rate' => 'nullable|numeric|min:0',
            'gross_weight' => 'nullable|numeric|min:0',
            'stone_weight' => 'nullable|numeric|min:0',
            'diamond_weight' => 'nullable|numeric|min:0',
            'net_weight' => 'nullable|numeric|min:0',

            // Pricing
            'stone_amount' => 'nullable|numeric|min:0',
            'diamond_rate' => 'nullable|numeric|min:0',
            'making_charge' => 'nullable|numeric|min:0',
            'card_charge' => 'nullable|numeric|min:0',
            'other_charge' => 'nullable|numeric|min:0',
            'total_amount' => 'nullable|numeric|min:0',
            'landing_cost' => 'nullable|numeric|min:0',
            'retail_percent' => 'nullable|numeric|min:0',
            'retail_cost' => 'nullable|numeric|min:0',
            'mrp_percent' => 'nullable|numeric|min:0',
            'mrp_cost' => 'nullable|numeric|min:0',

            // Certification
            'certificate_id' => 'required|string|max:255',
            'diamond_purchase_location' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:10',
            'clarity' => 'nullable|string|max:50',
            'cut' => 'nullable|string|max:100',
            'valuation' => 'nullable|numeric|min:0',
            'certificate_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
        ]);

        $card = Card::findOrFail($id);

        // ✅ Handle new certificate upload
        // if ($request->hasFile('diamond_image')) {
        //     if ($card->diamond_image && Storage::disk('public')->exists($card->diamond_image)) {
        //         Storage::disk('public')->delete($card->diamond_image);
        //     }

        //     $validated['diamond_image'] = $request->file('diamond_image')->store('diamond_certificates', 'public');
        // }

        // ✅ Normalize numeric fields (avoid empty string errors)
        foreach ([
            'gold_rate',
            'gross_weight',
            'stone_weight',
            'diamond_weight',
            'net_weight',
            'stone_amount',
            'diamond_rate',
            'making_charge',
            'card_charge',
            'other_charge',
            'total_amount',
            'landing_cost',
            'retail_percent',
            'retail_cost',
            'mrp_percent',
            'mrp_cost',
            'valuation'
        ] as $field) {
            $validated[$field] = is_numeric($validated[$field] ?? null)
                ? $validated[$field]
                : 0;
        }

        $card->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Card product details updated successfully.');
    }

    public function showAssignPage(Request $request)
    {
        $search = $request->input('search');

        // eager load ownership and owner resolution where helpful
        $query = Card::query()
            ->with(['ownership', 'ownership.card']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('certificate_id', 'like', "%{$search}%")
                    ->orWhere('item_name', 'like', "%{$search}%")
                    ->orWhereHas('ownership', function ($oq) use ($search) {
                        // search merchants by name/business (join users)
                        $oq->where(function ($oq2) use ($search) {
                            $oq2->where('owner_type', 'merchant')
                                ->whereIn('owner_id', function ($sub) use ($search) {
                                    $sub->select('id')->from('users')->where('name', 'like', "%{$search}%")
                                        ->orWhere('business_name', 'like', "%{$search}%");
                                });
                        });
                    });
            });
        }

        $cards = $query->orderBy('created_at', 'desc')->paginate(10);
        $merchants = \App\Models\User::where('role', 'merchant')->orderBy('name')->get();

        return view('admin.sales.create', compact('cards', 'merchants', 'search'));
    }


    public function lookup(Request $request)
    {
        $search = $request->get('q') ?? $request->get('barcode') ?? $request->get('product_code');

        $query = \DB::table('cards')
            ->leftJoin('products', 'cards.item_code', '=', 'products.item_code')
            ->select([
                'cards.id',
                'cards.product_code',
                'cards.item_code',
                'cards.item_name',
                'products.hsn_code as hsn',
                'cards.quantity',
                'cards.gross_weight',
                'cards.stone_weight',
                'cards.diamond_weight',
                'cards.net_weight',
                'cards.total_amount'
            ]);

        // 🟢 If user typed something, filter by it
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('cards.product_code', 'like', "%{$search}%")
                    ->orWhere('cards.item_name', 'like', "%{$search}%");
            });
        }

        // 🟢 Default limit
        $products = $query->limit(25)->get();

        return response()->json($products);
    }

    public function assignCard(Request $request)
    {
        $request->validate([
            'merchant_id' => 'required|exists:users,id'
        ]);

        DB::transaction(function () use ($request) {

            $items = TempSale::where('created_by', auth()->id())->get();

            foreach ($items as $item) {

                $ownership = CardOwnership::where('card_id', $item->card_id)
                    ->lockForUpdate()
                    ->first();

                if (!$ownership) {
                    CardOwnership::create([
                        'card_id' => $item->card_id,
                        'owner_type' => 'merchant',
                        'owner_id' => $request->merchant_id
                    ]);

                    CardOwnershipHistory::create([
                        'card_id' => $item->card_id,
                        'previous_owner_type' => 'admin',
                        'new_owner_type' => 'merchant',
                        'new_owner_id' => $request->merchant_id
                    ]);
                }
            }

            TempSale::where('created_by', auth()->id())->delete();
        });

        return back()->with('success', 'Cards assigned to merchant successfully.');
    }

    public function edit($id)
    {
        $card = Card::findOrFail($id);
        return view('admin.cards.edit', compact('card'));
    }

    public function destroy($id)
    {
        $card = Card::findOrFail($id);
        $card->delete();
        return redirect()->route('admin.products.index')->with('success', 'Card deleted successfully!');
    }

}
