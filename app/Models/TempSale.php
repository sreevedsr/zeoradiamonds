<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempSale extends Model
{
    protected $fillable = [
        'product_code',
        'card_id',
        'created_by'
    ];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

