<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TempSale;
use App\Models\Card; // your Card model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SaleAssignController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth'); // add role/gate as needed
    // }

    /**
     * Finalize an assignment:
     * - move/validate temp sales
     * - update cards table: set merchant_id for the provided card_id(s)
     */
    public function finalize(Request $request)
    {
        $data = $request->validate([
            'merchant_id' => 'required|integer|exists:users,id',
            'items' => 'required|array|min:1',
            'items.*.card_id' => 'required|integer|exists:cards,id',
        ]);

        DB::beginTransaction();
        try {
            foreach ($data['items'] as $item) {
                // create real sale (optional) or just update card
                $card = Card::findOrFail($item['card_id']);

                // update merchant assignment
                $card->merchant_id = $data['merchant_id'];
                $card->save();

                // Optionally: log the assignment in a sales/assignments table or fire event
                // AssignmentEvent::dispatch($card, $data['merchant_id'], auth()->id());
            }

            // delete temp rows created by current user for these cards (optional)
            TempSale::whereIn('card_id', collect($data['items'])->pluck('card_id'))->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Assigned cards to merchant successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Sale assignment failed: '.$e->getMessage());
            return redirect()->back()->withErrors('Failed to finalize assignment. Check logs.');
        }
    }
}
