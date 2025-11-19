<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardOwnership extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_id',
        'owner_type',
        'owner_id',
    ];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    // Resolve owner record (merchants are users, customers separate)
    public function owner()
    {
        return $this->morphTo(null, 'owner_type', 'owner_id'); // conceptual only; we'll resolve manually
    }

    // convenience helpers
    public function isMerchant(): bool
    {
        return $this->owner_type === 'merchant';
    }

    public function isCustomer(): bool
    {
        return $this->owner_type === 'customer';
    }
}
