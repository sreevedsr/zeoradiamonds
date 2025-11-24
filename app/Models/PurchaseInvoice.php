<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseInvoice extends Model

{

    use HasFactory;

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
