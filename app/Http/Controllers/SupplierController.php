<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\StateCode;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $suppliers = Supplier::when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('supplier_code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('state_code', 'like', "%{$search}%")
                    ->orWhere('state', 'like', "%{$search}%")
                    ->orWhere('gst_no', 'like', "%{$search}%");
            });
        })
            ->orderByDesc('created_at')
            ->paginate(25);


        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        $stateCodes = StateCode::all(['state_code', 'state_name', 'gstin_code']);

        return view('admin.suppliers.create', compact('stateCodes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_code' => 'required|string|max:50|unique:suppliers,supplier_code',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'state_code' => 'required|string|max:10',
            'state' => 'required|string|max:100',
            'gst_no' => 'required|string|max:20',
        ]);

        Supplier::create($request->only([
            'supplier_code',
            'name',
            'address',
            'phone',
            'state_code',
            'state',
            'gst_no',
        ]));

        return redirect()->route('admin.suppliers.create')
            ->with('success', 'Supplier added successfully!');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('admin.suppliers.index')
            ->with('success', 'Supplier deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $request->validate([
            'supplier_code' => 'required|string|max:50|unique:suppliers,supplier_code,' . $supplier->id,
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:15',
            'state_code' => 'required|string|max:10',
            'state' => 'required|string|max:100',
            'gst_no' => 'nullable|string|max:20',
        ]);

        $supplier->update($request->all());

        return redirect()->route('admin.suppliers.index')
            ->with('success', 'Supplier updated successfully.');
    }
}
