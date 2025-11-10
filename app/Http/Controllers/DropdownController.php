<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Product;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DropdownController extends Controller
{
    /**
     * Fetch dropdown data by type.
     * Uses cache for performance.
     */
    public function fetch(string $type)
    {
        return Cache::remember("dropdown_{$type}", now()->addMinutes(15), function () use ($type) {
            return match ($type) {
                'suppliers' => Supplier::select(
                    'id', 'name', 'supplier_code', 'phone', 'address', 'gst_no', 'state', 'state_code'
                )->get(),

                'staff' => Staff::select(
                    'id', 'name', 'code', 'phone_no', 'address'
                )->get(),

                'products' => Product::select(
                    'id', 'item_code', 'item_name'
                )->get(),

                'merchants' => User::where('role', 'merchant')->select(
                    'id', 'name', 'merchant_code', 'phone', 'gst_no', 'state', 'state_code', 'address'
                )->get(),

                default => response()->json([], 404),
            };
        });
    }

    /**
     * Combined endpoint: returns all dropdown data at once.
     */
    public function combined()
    {
        return Cache::remember('dropdown_combined', now()->addMinutes(15), function () {
            return [
                'suppliers' => Supplier::select('id', 'name', 'supplier_code')->get(),
                'staff'     => Staff::select('id', 'name', 'code')->get(),
                'products'  => Product::select('id', 'item_code', 'item_name')->get(),
                'merchants' => User::where('role', 'merchant')->select('id', 'name', 'merchant_code')->get(),
            ];
        });
    }
}
