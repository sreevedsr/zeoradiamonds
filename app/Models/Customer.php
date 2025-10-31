<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id',
        'name',
        'email',
        'phone',
        'city',
        'state',
        'address',
    ];

    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }
}


