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

        // Apply search safely (this fixes your OR bug)
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('certificate_id', 'like', "%{$search}%")
                    ->orWhere('item_name', 'like', "%{$search}%");
            });
        }

        $cards = $query->orderByDesc('created_at')->paginate(10);
        $merchants = \App\Models\User::where('role', 'merchant')->get();

        return view('admin.sales.create', compact('cards', 'merchants', 'search'));
    }


    /**
     * Admin → Merchant Assignment
     */
    public function assignCard(Request $request)
    {
        $request->validate([
            'merchant_id' => 'required|exists:users,id'
        ]);

        $items = TempSale::where('created_by', Auth::id())->get();

        // Pre-check (fail fast)
        foreach ($items as $item) {
            $ownership = CardOwnership::where('card_id', $item->card_id)->first();

            if (!$ownership || $ownership->owner_type !== 'admin') {
                return back()->withErrors([
                    'error' => "Card {$item->card_id} is already assigned and cannot be reassigned."
                ]);
            }
        }

        // Assign safely
        DB::transaction(function () use ($request, $items) {

            foreach ($items as $item) {

                $ownership = CardOwnership::where('card_id', $item->card_id)
                    ->lockForUpdate()
                    ->first();

                // THIS SHOULD ALWAYS EXIST because admin always owns it
                $ownership->update([
                    'owner_type' => 'merchant',
                    'owner_id' => $request->merchant_id,
                ]);

                // Log ownership change
                CardOwnershipHistory::create([
                    'card_id' => $item->card_id,
                    'previous_owner_type' => 'admin',
                    'new_owner_type' => 'merchant',
                    'new_owner_id' => $request->merchant_id,
                    'changed_by' => Auth::id(),
                ]);
            }

            // Remove temp items
            TempSale::where('created_by', Auth::id())->delete();
        });

        return back()->with('success', 'Cards assigned successfully.');
    }
}
