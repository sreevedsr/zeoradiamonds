<?php

// app/Http/Controllers/CardController.php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CardController extends Controller
{
    /**
     * Return full card details for a given id.
     */
    public function show($id)
    {
        $cacheKey = "card_{$id}";

        return Cache::remember($cacheKey, now()->addMinutes(5), function () use ($id) {
            $card = Card::findOrFail($id);

            // return everything; you can ->makeHidden or ->only(...) if you prefer
            return response()->json($card);
        });
    }
}
