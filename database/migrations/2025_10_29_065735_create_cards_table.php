<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('cards');

        Schema::create('cards', function (Blueprint $table) {
            $table->id();

            /* --------------------------------------------------------------
             |  Product Details
             --------------------------------------------------------------*/
            $table->string('product_code')->unique();
            $table->string('item_code')->nullable();
            $table->string('item_name')->nullable();
            $table->decimal('quantity', 10, 2)->default(1);

            /* --------------------------------------------------------------
             |  Weights (grams)
             --------------------------------------------------------------*/
            $table->decimal('gross_weight', 10, 3)->default(0);
            $table->decimal('stone_weight', 10, 3)->default(0);
            $table->decimal('diamond_weight', 10, 3)->default(0);
            $table->decimal('net_weight', 10, 3)->default(0);

            /* --------------------------------------------------------------
             |  Rates
             --------------------------------------------------------------*/
            $table->decimal('gold_rate', 10, 2)->default(0);
            $table->decimal('diamond_rate', 10, 2)->default(0);

            /* --------------------------------------------------------------
             |  Charges & Costs
             --------------------------------------------------------------*/
            $table->decimal('stone_amount', 10, 2)->default(0);
            $table->decimal('making_charge', 10, 2)->default(0);
            $table->decimal('card_charge', 10, 2)->default(0);
            $table->decimal('other_charge', 10, 2)->default(0);
            $table->decimal('landing_cost', 12, 2)->default(0);

            $table->decimal('retail_percent', 8, 2)->default(0);
            $table->decimal('retail_cost', 12, 2)->default(0);

            $table->decimal('mrp_percent', 8, 2)->default(0);
            $table->decimal('mrp_cost', 12, 2)->default(0);

            $table->decimal('total_amount', 12, 2)->default(0);

            /* --------------------------------------------------------------
             |  Certification
             --------------------------------------------------------------*/
            $table->string('certificate_id')->nullable();
            $table->string('color', 10)->nullable();
            $table->string('clarity', 50)->nullable();
            $table->string('cut', 100)->nullable();
            $table->string('certificate_code')->nullable();

            /* --------------------------------------------------------------
             |  Images
             --------------------------------------------------------------*/
            $table->string('certificate_image')->nullable();
            $table->string('product_image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
