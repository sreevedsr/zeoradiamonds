<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardOwnershipHistory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'card_ownership_history';

    protected $fillable = [
        'card_id',
        'previous_owner_type',
        'previous_owner_id',
        'new_owner_type',
        'new_owner_id',
        'changed_by',
        'changed_at',
    ];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    public function changer()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
