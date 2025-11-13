<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_id',
        'barcode',
        'product_code',
        'item_code',
        'item_name',
        'hsn',
        'quantity',
        'gross_weight',
        'stone_weight',
        'diamond_weight',
        'net_weight',
        'net_amount',
        'cgst',
        'sgst',
        'igst',
        'total_amount',
        'merchant_id',
        'created_by'
    ];

    public function card()
    {
        return $this->belongsTo(Card::class, 'card_id');
    }

    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id'); // adjust User model if merchants use another model
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
