<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'hsn_code' => $this->faker->numerify('####'),
            'item_code' => strtoupper($this->faker->unique()->bothify('ITM####')),
            'item_name' => $this->faker->word(),
        ];
    }

}
