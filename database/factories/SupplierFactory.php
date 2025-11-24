<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    public function definition()
    {
        return [
            'supplier_code' => strtoupper($this->faker->unique()->bothify('SUP###')),
            'name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'state_code' => 'KL',
            'state' => 'Kerala',
            'gst_no' => strtoupper($this->faker->bothify('##AAAAA####A1Z#')),
        ];
    }
}
