<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardOwnershipHistoryFactory extends Factory
{
    public function definition()
    {
        return [
            'card_id' => Card::factory(),
            'previous_owner_type' => 'admin',
            'previous_owner_id' => null,
            'new_owner_type' => 'merchant',
            'new_owner_id' => User::factory(),
            'changed_by' => User::factory(),
            'changed_at' => now(),
        ];
    }
}
