<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Product;
use App\Models\Staff;
use App\Models\User;
use App\Models\Card;
use Illuminate\Http\Request;

class DropdownController extends Controller
{
    /**
     * Fetch dropdown data by type.
     * No caching – always return fresh data.
     */
    public function fetch(string $type)
    {
        switch ($type) {

            case 'suppliers':
                return Supplier::select(
                    'id',
                    'name',
                    'supplier_code',
                    'phone',
                    'address',
                    'gst_no',
                    'state',
                    'state_code'
                )->get();

            case 'staff':
                return Staff::select(
                    'id',
                    'name',
                    'code',
                    'phone_no',
                    'address'
                )->get();

            case 'products':
                return Product::select(
                    'id',
                    'item_code',
                    'item_name'
                )->get();

            case 'merchants':
                return User::where('role', 'merchant')->select(
                    'id',
                    'name',
                    'merchant_code',
                    'phone',
                    'gst_no',
                    'state',
                    'state_code',
                    'address'
                )->get();

            /**
             * -----------------------------------------------------
             *  SALE PRODUCTS (admin assigns cards to merchants)
             *  Only show cards that are:
             *   → owner_type = admin
             *   → owner_id IS NULL
             *  And join with products table for names + HSN.
             * -----------------------------------------------------
             */
            case 'sale_products':
                return Card::query()
                    ->with(['ownership', 'product'])
                    ->whereHas('ownership', function ($q) {
                        $q->where('owner_type', 'admin')
                            ->whereNull('owner_id');
                    })
                    ->whereDoesntHave('tempSales', function ($q) {
                        $q->where('created_by', auth()->id());
                    })
                    ->get()
                    ->map(function ($card) {
                        return [
                            'id' => $card->id,
                            'product_code' => $card->product_code,
                            'item_code' => $card->item_code,
                            'item_name' => $card->product->item_name ?? null,
                            'hsn_code' => $card->product->hsn_code ?? null,
                            'gross_weight' => $card->gross_weight,
                            'stone_weight' => $card->stone_weight,
                            'diamond_weight' => $card->diamond_weight,
                            'net_weight' => $card->net_weight,
                        'total_amount' => $card->total_amount,
                        ];
                    });

            default:
                return response()->json([], 404);
        }
    }

    /**
     * Combined dropdown API (no caching)
     */
    public function combined()
    {
        return [
            'suppliers' => Supplier::select('id', 'name', 'supplier_code')->get(),
            'staff' => Staff::select('id', 'name', 'code')->get(),
            'products' => Card::select('id', 'item_code')->get(),
            'merchants' => User::where('role', 'merchant')->select('id', 'name', 'merchant_code')->get(),
        ];
    }
}
