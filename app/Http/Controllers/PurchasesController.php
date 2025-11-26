<?php

namespace App\Http\Controllers;

use App\Models\PurchaseInvoice;
use App\Models\Supplier;
use App\Models\Staff;
use App\Models\GoldRate;
use App\Models\TempPurchaseItem;
use App\Models\Card;
use App\Models\CardOwnership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchasesController extends Controller
{
    public function index()
    {
        return view('admin.purchases.index');
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('name')->get();
        $staff = Staff::orderBy('name')->get();

        $lastInvoice = PurchaseInvoice::latest('id')->first();
        $nextInvoiceNo = 'INV-' . str_pad(($lastInvoice?->id ?? 0) + 1, 5, '0', STR_PAD_LEFT);
        $latestGoldRate = GoldRate::latest()->value('rate') ?? 0;

        return view('admin.purchases.create', compact('suppliers', 'staff', 'nextInvoiceNo', 'latestGoldRate'));
    }

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'invoice_no' => 'required|string|max:100|unique:purchase_invoices,invoice_no',
            'invoice_date' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $tempItems = TempPurchaseItem::where('user_id', Auth::id())->get();

        if ($tempItems->isEmpty()) {
            return back()->withErrors(['items' => 'Add at least one item.']);
        }

        try {
            DB::beginTransaction();

            $invoice = PurchaseInvoice::create($validated);

            foreach ($tempItems as $item) {

                // Move certificate image if exists
                $certificateImage = null;
                if ($item->certificate_image) {
                    $certificateImage = str_replace('temp/', 'certificates/', $item->certificate_image);
                    \Storage::disk('public')->move($item->certificate_image, $certificateImage);
                }

                // Move product image if exists
                $productImage = null;
                if ($item->product_image) {
                    $productImage = str_replace('temp/', 'products/', $item->product_image);
                    \Storage::disk('public')->move($item->product_image, $productImage);
                }

                // Create Card
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

                    // 🔥 Save final paths, NOT temp paths
                    'certificate_image' => $certificateImage,
                    'product_image' => $productImage,
                ]);

                CardOwnership::create([
                    'card_id' => $card->id,
                    'owner_type' => 'admin',
                    'owner_id' => null,
                ]);
            }


            TempPurchaseItem::where('user_id', Auth::id())->delete();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }

        return redirect()
            ->route('admin.products.create')
            ->with('success', "Invoice created.")
            ->with('clear_items', true);
    }
}
