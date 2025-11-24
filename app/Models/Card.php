<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_invoice_id',
        'product_code',
        'item_code',
        'quantity',
        'gold_rate',
        'diamond_rate',
        'gross_weight',
        'stone_weight',
        'diamond_weight',
        'net_weight',
        'stone_amount',
        'making_charge',
        'card_charge',
        'other_charge',
        'landing_cost',
        'retail_percent',
        'retail_cost',
        'mrp_percent',
        'mrp_cost',
        'total_amount',
        'certificate_id',
        'color',
        'clarity',
        'cut',
        'certificate_image',
        'product_image',
    ];

    protected $casts = [
        'gross_weight' => 'decimal:3',
        'stone_weight' => 'decimal:3',
        'diamond_weight' => 'decimal:3',
        'net_weight' => 'decimal:3',
        'gold_rate' => 'decimal:2',
        'diamond_rate' => 'decimal:2',
        'stone_amount' => 'decimal:2',
        'making_charge' => 'decimal:2',
        'card_charge' => 'decimal:2',
        'other_charge' => 'decimal:2',
        'landing_cost' => 'decimal:2',
        'retail_percent' => 'decimal:2',
        'retail_cost' => 'decimal:2',
        'mrp_percent' => 'decimal:2',
        'mrp_cost' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    /*------------------------------------------
     | Attribute Aliases
     ------------------------------------------*/

    public function getInvoiceDateAttribute()
    {
        return $this->date;
    }

    public function setInvoiceDateAttribute($value)
    {
        $this->date = $value;
    }

    /*------------------------------------------
     | Relationships
     ------------------------------------------*/

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

    public function tempSales()
    {
        return $this->hasMany(TempSale::class, 'card_id');
    }


    // CURRENT OWNER (only one row in table)
    public function ownership()
    {
        return $this->hasOne(CardOwnership::class);
    }

    // history table
    public function ownershipHistory()
    {
        return $this->hasMany(CardOwnershipHistory::class);
    }

    // convenience: returns owner model instance
    public function currentOwnerModel()
    {
        $o = $this->ownership()->first();
        if (!$o)
            return null;

        return match ($o->owner_type) {
            'merchant' => User::find($o->owner_id),
            'customer' => Customer::find($o->owner_id),
            default => User::find($o->owner_id),
        };
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'item_code', 'item_code');
    }


    /*------------------------------------------
     | Ownership Scopes
     ------------------------------------------*/

    public function scopeOwnedByAdmin($q)
    {
        return $q->whereHas('ownership', function ($sub) {
            $sub->where('owner_type', 'admin');
        });
    }

    public function scopeOwnedByMerchant($q, $merchantId)
    {
        return $q->whereHas('ownership', function ($sub) use ($merchantId) {
            $sub->where('owner_type', 'merchant')
                ->where('owner_id', $merchantId);
        });
    }

    public function scopeOwnedByCustomer($q, $customerId)
    {
        return $q->whereHas('ownership', function ($sub) use ($customerId) {
            $sub->where('owner_type', 'customer')
                ->where('owner_id', $customerId);
        });
    }
}
