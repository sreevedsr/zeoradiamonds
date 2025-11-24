<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StaffFactory extends Factory
{
    public function definition()
    {
        return [
            'code' => strtoupper($this->faker->unique()->bothify('STF###')),
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'phone_no' => $this->faker->numerify('9#########'),
        ];
    }
}
