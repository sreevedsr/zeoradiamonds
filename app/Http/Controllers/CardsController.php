<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class CardsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $cards = Card::with('merchant')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('certificate_id', 'like', "%{$search}%")
                        ->orWhere('diamond_purchase_location', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%")
                        ->orWhere('diamond_shape', 'like', "%{$search}%")
                        ->orWhere('carat_weight', 'like', "%{$search}%")
                        ->orWhere('clarity', 'like', "%{$search}%")
                        ->orWhere('color', 'like', "%{$search}%")
                        ->orWhere('cut', 'like', "%{$search}%")
                        ->orWhereHas('merchant', function ($m) use ($search) {
                            $m->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        $merchants = User::where('role', 'merchant')->orderBy('name')->get();

        return view('admin.cards.index', compact('cards', 'merchants'));
    }


    public function store(Request $request)
    {
        // ✅ Ensure only admins can add cards
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        // ✅ Validate incoming data
        $validatedData = $request->validate([
            'certificate_id' => 'required|string|max:100|unique:cards,certificate_id',
            'diamond_purchase_location' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'diamond_shape' => 'required|string|max:100',
            'carat_weight' => 'required|numeric|min:0',
            'clarity' => 'required|string|max:50',
            'color' => 'required|string|size:1',
            'cut' => 'required|string|max:50',
            'valuation' => 'required|numeric|min:0', // ✅ New validation rule
            'diamond_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240', // 10MB max
        ]);

        // ✅ Handle image upload (if provided)
        $imagePath = null;
        if ($request->hasFile('diamond_image')) {
            $imagePath = $request->file('diamond_image')->store('diamond_certificates', 'public');
        }

        // ✅ Save card in the database
        Card::create([
            'certificate_id' => $validatedData['certificate_id'],
            'diamond_purchase_location' => $validatedData['diamond_purchase_location'],
            'category' => $validatedData['category'],
            'diamond_shape' => $validatedData['diamond_shape'],
            'carat_weight' => $validatedData['carat_weight'],
            'clarity' => $validatedData['clarity'],
            'color' => $validatedData['color'],
            'cut' => $validatedData['cut'],
            'valuation' => $validatedData['valuation'], // ✅ Save valuation
            'diamond_image' => $imagePath,
        ]);

        // ✅ Redirect back with success message
        return redirect()->back()->with('success', 'Diamond certificate added successfully!');
    }


    public function update(Request $request, $id)
    {
        // Check role
        if (!Auth::user() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        // Validate input
        $validatedData = $request->validate([
            'certificate_id' => 'required|string|max:255',
            'diamond_purchase_location' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'diamond_type' => 'required|string|max:100',
            'carat_weight' => 'required|numeric|min:0',
            'clarity' => 'required|string|max:50',
            'color' => 'required|string|max:5',
            'cut' => 'required|string|max:100',
            'diamond_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240', // optional image
        ]);

        // Find card
        $card = Card::findOrFail($id);

        // Handle image update (if new image uploaded)
        if ($request->hasFile('diamond_image')) {
            // Delete old image if it exists
            if ($card->diamond_image && file_exists(public_path('storage/' . $card->diamond_image))) {
                unlink(public_path('storage/' . $card->diamond_image));
            }

            // Store new image
            $path = $request->file('diamond_image')->store('diamond_images', 'public');
            $validatedData['diamond_image'] = $path;
        }

        // Update card record
        $card->update($validatedData);

        // Redirect back
        return redirect()->route('admin.cards.index')->with('success', 'Card details updated successfully!');
    }

    public function showAssignPage(Request $request)
    {
        $query = Card::with('merchant'); // eager load merchant

        // Search logic
        if ($search = $request->input('search')) {
            $query->where('card_number', 'like', "%{$search}%")
                ->orWhereHas('merchant', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('business_name', 'like', "%{$search}%");
                });
        }

        $cards = $query->orderBy('created_at', 'desc')->paginate(10);
        $merchants = User::where('role', 'merchant')->orderBy('name')->get();

        return view('admin.cards.assign', compact('cards', 'merchants', 'search'));
    }

    // Handle card assignment
    public function assignCard(Request $request)
    {
        // Base merchant validation (exists as user + has role merchant)
        $request->validate([
            'merchant_id' => [
                'required',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    $user = User::find($value);
                    if (!$user || $user->role !== 'merchant') {
                        $fail('The selected user is not a merchant.');
                    }
                },
            ],
        ]);

        $merchantId = $request->merchant_id;

        // If card_id provided -> assign existing card to merchant

        $request->validate([
            'card_id' => 'required|exists:cards,id',
        ]);

        $card = Card::find($request->card_id);

        \Log::info('Before refresh', [
            'card_id' => $card->id,
            'merchant_id_in_card' => $card->merchant_id,
            'merchant_id_in_request' => $request->merchant_id,
            'same_before_refresh' => $card->merchant_id == $request->merchant_id,
        ]);

        $card->refresh();

        \Log::info('After refresh', [
            'merchant_id_in_card' => $card->merchant_id,
            'merchant_id_in_request' => $request->merchant_id,
            'same_after_refresh' => $card->merchant_id == $request->merchant_id,
        ]);
        // optional: check if already assigned
        if ($card->merchant_id == $merchantId) {
            return redirect()->route('admin.cards.assign')
                ->with('info', 'Card is already assigned to the selected merchant.');

        }

        $card->merchant_id = $merchantId;
        $card->save();
        // dd($card->merchant_id, $card->merchant ? $card->merchant->id : null);


        return redirect()->route('admin.cards.assign')
            ->with('success', 'Card assigned to merchant successfully!');
    }


    public function edit($id)
    {
        $card = Card::findOrFail($id);
        return view('admin.cards.edit', compact('card'));
    }

    public function destroy($id)
    {
        $card = Card::findOrFail($id);
        $card->delete();
        return redirect()->route('admin.cards.index')->with('success', 'Card deleted successfully!');
    }

}
