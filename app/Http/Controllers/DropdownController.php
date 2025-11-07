<?php

// app/Http/Controllers/DropdownController.php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Staff;
use Illuminate\Http\Request;

class DropdownController extends Controller
{
    public function fetch(string $type)
    {
        return match ($type) {
            'suppliers' => Supplier::select('id', 'name', 'supplier_code', 'phone', 'address', 'gst_no', 'state', 'state_code')->get(),
            'staff' => Staff::select('id', 'name', 'code', 'phone_no', 'address')->get(),
            default => response()->json([], 404),
        };
    }
}
