<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'certificate_id',
        'diamond_purchase_location',
        'category',
        'diamond_type',
        'carat_weight',
        'clarity',
        'color',
        'cut',
        'diamond_image',
        'merchant_id',
    ];
    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id')
            ->where('role', 'merchant');
    }


}

