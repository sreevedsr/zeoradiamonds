<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseInvoiceFactory extends Factory
{
    public function definition()
    {
        return [
            'invoice_no' => strtoupper($this->faker->unique()->bothify('INV#####')),
            'invoice_date' => $this->faker->date(),
            'supplier_id' => Supplier::factory(),
        ];
    }
}
