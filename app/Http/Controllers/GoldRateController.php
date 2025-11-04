<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoldRate;

class GoldRateController extends Controller
{
    /**
     * Display a listing of the gold rates.
     */
    public function index()
    {
        $goldRates = GoldRate::latest()->paginate(10);
        return view('admin.goldrates.create', compact('goldRates'));
    }

    /**
     * Show the form for creating a new gold rate.
     */
    public function create()
    {
        return view('admin.goldrates.create');
    }
    public function diamond()
    {
        return view('admin.goldrates.diamond');
    }

    /**
     * Store a newly created gold rate in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rate' => 'required|numeric',
            // 'date' => 'required|date',
        ]);

        GoldRate::create($request->only('rate', 'date'));

        return redirect()
            ->route('admin.goldrates.index')
            ->with('success', 'Gold rate added successfully.');
    }

    /**
     * Remove the specified gold rate from storage.
     */
    public function destroy($id)
    {
        $goldRate = GoldRate::findOrFail($id);
        $goldRate->delete();

        return redirect()
            ->route('admin.goldrates.index')
            ->with('success', 'Gold rate deleted successfully.');
    }
}
