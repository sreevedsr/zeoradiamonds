<?php

namespace Database\Factories;

use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardOwnershipFactory extends Factory
{
    public function definition()
    {
        return [
            'card_id' => Card::factory(),
            'owner_type' => 'admin',
            'owner_id' => null,
        ];
    }
}
