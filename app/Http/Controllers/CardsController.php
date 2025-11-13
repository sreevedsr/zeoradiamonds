<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Staff;
use App\Models\Invoice;
use App\Models\GoldRate;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\TempPurchaseItem;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
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
                        ->orWhere('diamond_purchase_location', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%")
                        ->orWhere('diamond_shape', 'like', "%{$search}%")
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

        $lastInvoice = Invoice::latest('id')->first();
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

        // Validate the top-level invoice fields
        $validated = $request->validate([
            'invoice_no' => 'required|string|max:100|unique:invoices,invoice_no',
            'invoice_date' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        // Fetch temp items for the logged-in admin
        $tempItems = TempPurchaseItem::where('user_id', auth()->id())->get();

        if ($tempItems->isEmpty()) {
            return back()->withErrors(['items' => 'You must add at least one item before submitting the invoice.']);
        }

        // Create Invoice
        $invoice = Invoice::create([
            'invoice_no' => $validated['invoice_no'],
            'invoice_date' => $validated['invoice_date'],
            'supplier_id' => $validated['supplier_id'],
        ]);

        // Loop through each temp item and move to cards table
        foreach ($tempItems as $item) {
            Card::create($item->only([
                'invoice_no',
                'invoice_date',
                'supplier_id',
                'product_code',
                'item_code',
                'item_name',
                'quantity',
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
                'certificate_id',
                'category',
                'diamond_shape',
                'color',
                'clarity',
                'cut',
                'certificate_code',
                'diamond_image',
                'product_image'
            ]));
        }

        // Delete temp items after move
        TempPurchaseItem::where('user_id', auth()->id())->delete();

        return redirect()
            ->back()
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
            'category' => 'nullable|string|max:100',
            'diamond_shape' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:10',
            'clarity' => 'nullable|string|max:50',
            'cut' => 'nullable|string|max:100',
            'valuation' => 'nullable|numeric|min:0',
            'diamond_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
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
        $query = Card::with('merchant'); // eager load merchant

        // Search logic
        if ($search = $request->input('search')) {
            $query->where('card_number', 'like', "%{$search}%")
                ->orWhereHas('merchant', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('business_name', 'like', "%{$search}%");
                });
        }

        $cards = $query->orderBy('created_at', 'desc')->paginate(10);
        $merchants = User::where('role', 'merchant')->orderBy('name')->get();

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

    // Handle card assignment
    public function assignCard(Request $request)
    {
        // Base merchant validation (exists as user + has role merchant)
        $request->validate([
            'merchant_id' => [
                'required',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    $user = User::find($value);
                    if (!$user || $user->role !== 'merchant') {
                        $fail('The selected user is not a merchant.');
                    }
                },
            ],
        ]);

        $merchantId = $request->merchant_id;

        // If card_id provided -> assign existing card to merchant

        $request->validate([
            'card_id' => 'required|exists:cards,id',
        ]);

        $card = Card::find($request->card_id);

        \Log::info('Before refresh', [
            'card_id' => $card->id,
            'merchant_id_in_card' => $card->merchant_id,
            'merchant_id_in_request' => $request->merchant_id,
            'same_before_refresh' => $card->merchant_id == $request->merchant_id,
        ]);

        $card->refresh();

        \Log::info('After refresh', [
            'merchant_id_in_card' => $card->merchant_id,
            'merchant_id_in_request' => $request->merchant_id,
            'same_after_refresh' => $card->merchant_id == $request->merchant_id,
        ]);
        // optional: check if already assigned
        if ($card->merchant_id == $merchantId) {
            return redirect()->route('admin.products.assign')
                ->with('info', 'Card is already assigned to the selected merchant.');

        }

        $card->merchant_id = $merchantId;
        $card->save();
        // dd($card->merchant_id, $card->merchant ? $card->merchant->id : null);


        return redirect()->route('admin.products.assign')
            ->with('success', 'Card assigned to merchant successfully!');
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
