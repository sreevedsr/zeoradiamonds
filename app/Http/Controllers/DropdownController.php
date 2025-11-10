<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Product;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;

class DropdownController extends Controller
{
    public function fetch(string $type)
    {
        return match ($type) {
            // Suppliers Dropdown
            'suppliers' => Supplier::select(
                'id',
                'name',
                'supplier_code',
                'phone',
                'address',
                'gst_no',
                'state',
                'state_code'
            )->get(),

            // Staff Dropdown
            'staff' => Staff::select(
                'id',
                'name',
                'code',
                'phone_no',
                'address'
            )->get(),

            // Products Dropdown
            'products' => Product::select(
                'id',
                'item_code',
                'item_name'
            )->get(),

            // ✅ Merchants Dropdown (filtered by role column)
            'merchants' => User::where('role', 'merchant')
                ->select(
                    'id',
                    'name',
                    'merchant_code',
                    'phone',
                    'gst_no',
                    'state',
                    'state_code',
                    'address'
                )
                ->get(),

            default => response()->json([], 404),
        };
    }
}
