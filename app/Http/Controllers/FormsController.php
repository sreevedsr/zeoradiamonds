<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Card; // assuming you have a Card model

class FormsController extends Controller
{
    /**
     * Show the form for adding new cards (admin only).
     */
    public function index()
    {
        // Allow only admins
        if (!Auth::user() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        return view('forms.index');
    }

    /**
     * Store a new card in the database.
     */
    public function store(Request $request)
    {
        if (!Auth::user() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cards', 'public');
        }

        Card::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Card added successfully!');
    }
}
