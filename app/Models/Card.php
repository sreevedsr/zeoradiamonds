<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        // 🔹 Invoice / Sale Information
        'purchase_invoice_id',

        // 🔹 Product / Item Details
        'product_code',
        'item_code',
        'item_name',
        'quantity',

        // 🔹 Gold / Weight / Rates
        'gold_rate',
        'diamond_rate',
        'gross_weight',
        'stone_weight',
        'diamond_weight',
        'net_weight',

        // 🔹 Charges
        'stone_amount',
        'making_charge',
        'card_charge',
        'other_charge',
        'landing_cost',

        // 🔹 Retail / MRP normalized
        'retail_cost_percent',  // DB original
        'retail_cost',
        'mrp_cost_percent',     // DB original
        'mrp_cost',

        // 🔹 Certification / Diamond Details
        'certificate_id',
        'certificate_code',
        'diamond_purchase_location',
        'category',
        'diamond_shape',        // normalized alias
        'clarity',
        'color',
        'cut',
        'certificate_image',

        // 🔹 Valuation & Pricing
        'valuation',
        'price',
        'discount',
        'final_price',

        // 🔹 Merchant / Customer
        'merchant_id',
        'customer_id',
    ];

    protected $casts = [
        // Dates
        'date' => 'date',

        // Weights
        'gross_weight' => 'decimal:3',
        'stone_weight' => 'decimal:3',
        'diamond_weight' => 'decimal:3',
        'net_weight' => 'decimal:3',

        // Rates & Charges
        'gold_rate' => 'decimal:2',
        'diamond_rate' => 'decimal:2',
        'stone_amount' => 'decimal:2',
        'making_charge' => 'decimal:2',
        'card_charge' => 'decimal:2',
        'other_charge' => 'decimal:2',

        // Retail / MRP
        'retail_cost_percent' => 'decimal:2',
        'retail_cost' => 'decimal:2',
        'mrp_cost_percent' => 'decimal:2',
        'mrp_cost' => 'decimal:2',

        // Pricing
        'valuation' => 'decimal:2',
        'price' => 'decimal:2',
        'discount' => 'decimal:2',
        'final_price' => 'decimal:2',
    ];

    /* ---------------------------------------------
     | 🧩 Normalized Attribute Aliases (So UI can use modern names)
     ----------------------------------------------*/

    // UI uses: invoice_date → DB field: date
    public function getInvoiceDateAttribute()
    {
        return $this->date;
    }

    public function setInvoiceDateAttribute($value)
    {
        $this->date = $value;
    }


    /* ---------------------------------------------
     |  🔹 Relationships
     ----------------------------------------------*/

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseInvoice()
    {
        return $this->belongsTo(PurchaseInvoice::class, 'purchase_invoice_id');
    }


    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
