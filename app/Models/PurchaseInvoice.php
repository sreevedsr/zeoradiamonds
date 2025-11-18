<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    protected $fillable = [
        'invoice_no',
        'invoice_date',
        'supplier_id',
    ];
    public function cards()
    {
        return $this->hasMany(Card::class, 'purchase_invoice_id');
    }

}
