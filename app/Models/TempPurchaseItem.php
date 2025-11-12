<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempPurchaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'item_name', 'quantity', 'gold_rate', 'total_amount',
    ];
}
