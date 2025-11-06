<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $query = Staff::query();

        // Optional search handling
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('phone_no', 'like', "%{$search}%");
            });
        }

        // Optional filter (e.g., department or role — future use)
        if ($filter = $request->get('filter')) {
            $query->where('department', $filter);
        }

        // Paginate results
        $staff = $query->orderBy('name')->paginate(10)->withQueryString();

        // For live search/filter via AJAX requests
        if ($request->ajax()) {
            return view('admin.staff.index', compact('staff'))->render();
        }

        // Regular page render
        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:staff,code',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_no' => 'required|string|max:15',
        ]);

        Staff::create($request->all());

        return redirect()->route('admin.staff.index')->with('success', 'Staff registered successfully!');
    }
}
