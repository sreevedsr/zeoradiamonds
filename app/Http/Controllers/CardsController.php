<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Staff;
use App\Models\Invoice;
use App\Models\Supplier;
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

    public function createCard()
    {
        $suppliers = Supplier::orderBy('name')->get();
        $staff = Staff::orderBy('name')->get();

        $lastInvoice = Invoice::latest('id')->first();
        $nextInvoiceNo = 'INV-' . str_pad(($lastInvoice?->id ?? 0) + 1, 5, '0', STR_PAD_LEFT);

        return view('admin.purchases.create', compact('suppliers', 'staff', 'nextInvoiceNo'));
    }

    public function storeCard(Request $request)
    {
        // ✅ Only admins
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        // ✅ Validate fields
        $validated = $request->validate([
            'invoice_no' => 'required|string|max:100|unique:invoices,invoice_no',
            'invoice_date' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id', // ✅ validate by ID
            'staff_id' => 'required|exists:staff,id',         // ✅ validate by ID
            'items_json' => 'required|string',                // JSON array
        ]);

        // ✅ Fetch related supplier & staff details
        $supplier = Supplier::find($validated['supplier_id']);
        $staff = Staff::find($validated['staff_id']);

        // ✅ Create invoice with related info
        $invoice = Invoice::create([
            'invoice_no' => $validated['invoice_no'],
            'invoice_date' => $validated['invoice_date'],
            'supplier_id' => $supplier->id,
            'staff_id' => $staff->id,
        ]);

        // ✅ Decode JSON items
        $items = json_decode($validated['items_json'], true);
        if (!is_array($items) || empty($items)) {
            return back()->withErrors(['items_json' => 'No valid items found.']);
        }

        // ✅ Store each item
        foreach ($items as $item) {
            $imagePath = null;
            if (isset($item['diamond_image']) && $item['diamond_image'] instanceof \Illuminate\Http\UploadedFile) {
                $imagePath = $item['diamond_image']->store('diamond_certificates', 'public');
            }

            Card::create([
                'invoice_id' => $invoice->id,
                'certificate_id' => $item['certificate_id'] ?? uniqid('CERT-'),
                'diamond_purchase_location' => $item['diamond_purchase_location'] ?? 'N/A',
                'category' => $item['category'] ?? 'General',
                'diamond_shape' => $item['diamond_shape'] ?? 'Unknown',
                'carat_weight' => $item['carat_weight'] ?? 0,
                'clarity' => $item['clarity'] ?? 'N/A',
                'color' => $item['color'] ?? 'N/A',
                'cut' => $item['cut'] ?? 'N/A',
                'valuation' => $item['valuation'] ?? 0,
                'diamond_image' => $imagePath,
            ]);
        }

        return redirect()
            ->back()
            ->with('success', "Invoice #{$invoice->invoice_no} and items added successfully!")
            ->with('clear_items', true);

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
