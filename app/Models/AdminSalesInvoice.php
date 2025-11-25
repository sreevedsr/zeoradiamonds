<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminSalesInvoice extends Model
{
    protected $table = 'admin_sales_invoices';

    protected $fillable = [
        'product_code',
        'merchant_id',
        'invoice_no',
        'sale_date',
        'amount',
        'notes',
    ];

    protected $casts = [
        'sale_date' => 'date',
        'amount' => 'decimal:2',
    ];

    // Relationship to Card using non-standard key: product_code
    public function card()
    {
        return $this->belongsTo(Card::class, 'product_code', 'product_code');
    }

    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }
}
