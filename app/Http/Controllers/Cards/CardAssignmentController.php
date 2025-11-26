<?php

namespace App\Http\Controllers\Cards;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\TempSale;
use App\Models\CardOwnership;
use App\Models\CardOwnershipHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CardAssignmentController extends Controller
{
    /**
     * Admin – Show cards owned by admin only
     */
    public function showAssignPage(Request $request)
    {
        $search = $request->input('search');

        // Admin should see ONLY cards owned by admin
        $query = Card::with('ownership')
            ->whereHas('ownership', function ($q) {
                $q->where('owner_type', 'admin');
            });

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('certificate_id', 'like', "%{$search}%")
                    ->orWhere('item_name', 'like', "%{$search}%");
            });
        }

        $cards = $query->orderByDesc('created_at')->paginate(10);
        $merchants = \App\Models\User::where('role', 'merchant')->get();

        // 🔥 Get next Entry No from admin_sales_invoices
        $lastInvoice = \DB::table('admin_sales_invoices')->orderByDesc('id')->first();
        $nextEntryNo = $lastInvoice ? $lastInvoice->id + 1 : 1;

        return view('admin.sales.create', compact('cards', 'merchants', 'search', 'nextEntryNo'));
    }



    /**
     * Admin → Merchant Assignment
     */
    public function assignCard(Request $request)
    {
        $request->validate([
            'merchant_id' => 'required|exists:users,id',
            'invoice_no' => 'required|string|max:255',
            'salesman_id' => 'required|exists:staff,id',
        ]);

        $items = TempSale::where('created_by', Auth::id())->get();

        // Pre-checks
        foreach ($items as $item) {
            $ownership = CardOwnership::where('card_id', $item->card_id)->first();

            if (!$ownership || $ownership->owner_type !== 'admin') {
                return back()->withErrors([
                    'error' => "Card {$item->card_id} is already assigned and cannot be reassigned."
                ]);
            }
        }

        DB::transaction(function () use ($request, $items) {

            $invoiceNo = $request->invoice_no; // 🔥 Use Invoice No from form

            foreach ($items as $item) {

                // Lock and update ownership
                $ownership = CardOwnership::where('card_id', $item->card_id)
                    ->lockForUpdate()
                    ->first();

                $ownership->update([
                    'owner_type' => 'merchant',
                    'owner_id' => $request->merchant_id,
                ]);

                // Log to history
                CardOwnershipHistory::create([
                    'card_id' => $item->card_id,
                    'previous_owner_type' => 'admin',
                    'new_owner_type' => 'merchant',
                    'new_owner_id' => $request->merchant_id,
                    'changed_by' => Auth::id(),
                ]);

                // 🔥 Save sale into admin_sales_invoices (1 card = 1 row)
                \DB::table('admin_sales_invoices')->insert([
                    'product_code' => $item->product_code,
                    'merchant_id' => $request->merchant_id,
                    'staff_id' => $request->salesman_id,
                    'invoice_no' => $invoiceNo,
                    'sale_date' => now()->toDateString(),
                    'amount' => $item->amount ?? 0,
                    'notes' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Clear temp items
            TempSale::where('created_by', Auth::id())->delete();
        });

        return back()->with('success', 'Sales recorded successfully.');
    }

}
