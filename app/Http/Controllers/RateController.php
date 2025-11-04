<?php

namespace App\Http\Controllers;

use App\Models\DiamondRate;
use App\Models\GoldRate;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function index()
    {
        $latestGold = GoldRate::latest()->first();
        $latestDiamond = DiamondRate::latest()->first();

        $goldRates = GoldRate::latest()->take(5)->get();
        $diamondRates = DiamondRate::latest()->take(5)->get();

        return view('admin.rates.index', compact('latestGold', 'latestDiamond', 'goldRates', 'diamondRates'));
    }

    public function storeGold(Request $request)
    {
        $request->validate(['rate' => 'required|numeric|min:0']);
        GoldRate::create($request->only('rate'));

        return redirect()->back()->with('success', 'Gold rate added successfully!');
    }

    public function storeDiamond(Request $request)
    {
        $request->validate(['rate' => 'required|numeric|min:0']);
        DiamondRate::create($request->only('rate'));

        return redirect()->back()->with('success', 'Diamond rate added successfully!');
    }
}
