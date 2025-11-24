<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DiamondRateFactory extends Factory
{
    public function definition()
    {
        return [
            'rate' => $this->faker->randomFloat(2, 30000, 90000),
        ];
    }
}
