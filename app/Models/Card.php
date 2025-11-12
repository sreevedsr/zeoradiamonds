<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        // 🔹 Invoice Relations
        'invoice_id',
        'invoice_no',
        'invoice_date',
        'supplier_id',

        // 🔹 Product Details
        'product_code',
        'item_code',
        'item_name',
        'quantity',
        'gold_rate',
        'gross_weight',
        'stone_weight',
        'diamond_weight',
        'net_weight',

        // 🔹 Pricing & Charges
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

        // 🔹 Certification & Card Details
        'certificate_id',
        'diamond_purchase_location',
        'category',
        'diamond_shape',
        'clarity',
        'color',
        'cut',
        'valuation',
        'certificate_code',
        'diamond_image',

        // 🔹 Merchant Relationship (optional)
        'merchant_id',
    ];

    // 🔹 Attribute casting for numeric fields
    protected $casts = [
        'invoice_date' => 'date',
        'quantity' => 'decimal:2',
        'gold_rate' => 'decimal:2',
        'gross_weight' => 'decimal:3',
        'stone_weight' => 'decimal:3',
        'diamond_weight' => 'decimal:3',
        'net_weight' => 'decimal:3',
        'stone_amount' => 'decimal:2',
        'diamond_rate' => 'decimal:2',
        'making_charge' => 'decimal:2',
        'card_charge' => 'decimal:2',
        'other_charge' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'landing_cost' => 'decimal:2',
        'retail_percent' => 'decimal:2',
        'retail_cost' => 'decimal:2',
        'mrp_percent' => 'decimal:2',
        'mrp_cost' => 'decimal:2',
        'valuation' => 'decimal:2',
    ];

    // 🔹 Relationships
    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id')
            ->where('role', 'merchant');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
