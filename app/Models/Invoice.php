<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'invoice_no',
        'invoice_date',
        'supplier_id',
        'staff_id',
    ];


    /**
     * Relationship: One invoice has many cards.
     */
    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
