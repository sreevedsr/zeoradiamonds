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
    public function showAssignPage(Request $request)
    {
        $search = $request->input('search');

        $query = Card::with('ownership');

        if ($search) {
            $query->where('certificate_id', 'like', "%{$search}%")
                  ->orWhere('item_name', 'like', "%{$search}%");
        }

        $cards = $query->orderBy('created_at', 'desc')->paginate(10);
        $merchants = \App\Models\User::where('role', 'merchant')->get();

        return view('admin.sales.create', compact('cards', 'merchants', 'search'));
    }

    public function assignCard(Request $request)
    {
        $request->validate([
            'merchant_id' => 'required|exists:users,id'
        ]);

        DB::transaction(function () use ($request) {
            $items = TempSale::where('created_by', Auth::id())->get();

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

            TempSale::where('created_by', Auth::id())->delete();
        });

        return back()->with('success', 'Cards assigned.');
    }
}
