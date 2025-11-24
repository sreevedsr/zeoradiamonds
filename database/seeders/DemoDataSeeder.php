<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Staff;
use App\Models\GoldRate;
use App\Models\DiamondRate;
use App\Models\PurchaseInvoice;
use App\Models\Card;
use App\Models\CardOwnership;
use App\Models\CardOwnershipHistory;
use App\Models\TempPurchaseItem;
use App\Models\TempSale;
use App\Models\User;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Users (Admin + Merchants + Customers)
        User::factory()->count(10)->create();

        Product::factory()->count(20)->create();

        Supplier::factory()->count(10)->create();

        Staff::factory()->count(5)->create();

        GoldRate::factory()->count(10)->create();
        DiamondRate::factory()->count(10)->create();

        // Purchase invoices with linked cards
        PurchaseInvoice::factory()
            ->count(10)
            ->has(Card::factory()->count(5))
            ->create();

        // Ownerships for cards
        CardOwnership::factory()->count(50)->create();
        CardOwnershipHistory::factory()->count(50)->create();

        // Customers linked to merchants
        Customer::factory()->count(20)->create();

        // // Temp Items (for testing workflows)
        // TempPurchaseItem::factory()->count(20)->create();
        // TempSale::factory()->count(20)->create();
    }
}
