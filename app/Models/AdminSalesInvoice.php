<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminSalesInvoice extends Model
{
    protected $fillable = [
        'product_code',
        'merchant_id',
        'invoice_no',
        'sale_date',
        'amount',
        'notes',
    ];

    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }
}
