<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\PurchaseInvoice;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardFactory extends Factory
{
    public function definition()
    {
        return [
            'purchase_invoice_id' => PurchaseInvoice::factory(),
            'product_code' => strtoupper($this->faker->unique()->bothify('PRD####')),
            'item_code' => Product::factory(),
            'quantity' => 1,

            'gross_weight' => $this->faker->randomFloat(3, 1, 50),
            'stone_weight' => $this->faker->randomFloat(3, 0, 5),
            'diamond_weight' => $this->faker->randomFloat(3, 0, 3),
            'net_weight' => $this->faker->randomFloat(3, 1, 50),

            'gold_rate' => $this->faker->randomFloat(2, 4500, 7000),
            'diamond_rate' => $this->faker->randomFloat(2, 30000, 90000),

            'stone_amount' => $this->faker->randomFloat(2, 0, 10000),
            'making_charge' => $this->faker->randomFloat(2, 0, 5000),
            'card_charge' => $this->faker->randomFloat(2, 0, 500),
            'other_charge' => $this->faker->randomFloat(2, 0, 500),
            'landing_cost' => $this->faker->randomFloat(2, 10000, 50000),
            'retail_percent' => 10,
            'retail_cost' => $this->faker->randomFloat(2, 10000, 60000),
            'mrp_percent' => 15,
            'mrp_cost' => $this->faker->randomFloat(2, 15000, 65000),
            'total_amount' => $this->faker->randomFloat(2, 20000, 70000),

            'certificate_id' => strtoupper($this->faker->bothify('CERT###')),
            'color' => 'D',
            'clarity' => 'VVS1',
            'cut' => 'Excellent',
            'certificate_image' => null,
            'product_image' => null,
        ];
    }
}
