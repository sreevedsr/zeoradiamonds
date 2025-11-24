<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GoldRateFactory extends Factory
{
    public function definition()
    {
        return [
            'rate' => $this->faker->randomFloat(2, 4500, 7000),
        ];
    }
}
