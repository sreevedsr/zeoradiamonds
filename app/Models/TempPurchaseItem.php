<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempPurchaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_code',
        'item_code',
        'item_name',
        'quantity',
        'gold_rate',
        'gross_weight',
        'stone_weight',
        'diamond_weight',
        'net_weight',
        'stone_amount',
        'diamond_rate',
        'making_charge',
        'card_charge',
        'other_charge',
        'total_amount',
        'landing_cost',
        'retail_percent',
        'retail_cost',
        'mrp_percent',
        'mrp_cost',
        'certificate_id',
        'color',
        'clarity',
        'cut',
        'certificate_image',
        'product_image',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
