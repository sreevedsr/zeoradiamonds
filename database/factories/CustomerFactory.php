<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    public function definition()
    {
        return [
            'merchant_id' => User::factory(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'address' => $this->faker->address(),
        ];
    }
}
