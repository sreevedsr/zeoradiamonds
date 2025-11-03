<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
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
            ->paginate(10);

        // Prepare pagination data for table footer (optional but matches your merchant/card structure)
        $pagination = [
            'from' => $suppliers->firstItem(),
            'to' => $suppliers->lastItem(),
            'total' => $suppliers->total(),
            'pages' => range(1, $suppliers->lastPage()),
            'current' => $suppliers->currentPage(),
        ];

        return view('admin.suppliers.index', compact('suppliers', 'pagination'));
    }

    public function create()
    {
        return view('admin.suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_code' => 'required|string|max:50|unique:suppliers,supplier_code',
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'state_code' => 'nullable|string|max:10',
            'state' => 'nullable|string|max:100',
            'gst_no' => 'nullable|string|max:20',
        ]);

        Supplier::create($request->only([
            'supplier_code', 'name', 'address', 'phone', 'state_code', 'state', 'gst_no',
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

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('admin.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $request->validate([
            'supplier_code' => 'required|string|max:50',
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
