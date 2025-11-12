<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop old table if exists
        Schema::dropIfExists('cards');

        // Create new table with all required fields
        Schema::create('cards', function (Blueprint $table) {
            $table->id();

            // 🔹 Invoice relation
            $table->string('invoice_no', 100)->nullable();
            $table->date('invoice_date')->nullable();
            $table->foreignId('supplier_id')->nullable()->constrained()->onDelete('set null');

            // 🔹 Product Details
            $table->string('product_code', 255)->nullable();
            $table->string('item_code', 255)->nullable();
            $table->string('item_name', 255)->nullable();
            $table->decimal('quantity', 10, 2)->default(1);

            // 🔹 Gold & Weight Data
            $table->decimal('gold_rate', 10, 2)->default(0);
            $table->decimal('gross_weight', 10, 3)->default(0);
            $table->decimal('stone_weight', 10, 3)->default(0);
            $table->decimal('diamond_weight', 10, 3)->default(0);
            $table->decimal('net_weight', 10, 3)->default(0);

            // 🔹 Pricing & Charges
            $table->decimal('stone_amount', 10, 2)->default(0);
            $table->decimal('diamond_rate', 10, 2)->default(0);
            $table->decimal('making_charge', 10, 2)->default(0);
            $table->decimal('card_charge', 10, 2)->default(0);
            $table->decimal('other_charge', 10, 2)->default(0);
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->decimal('landing_cost', 12, 2)->default(0);

            // 🔹 Retail & MRP
            $table->decimal('retail_percent', 8, 2)->default(0);
            $table->decimal('retail_cost', 12, 2)->default(0);
            $table->decimal('mrp_percent', 8, 2)->default(0);
            $table->decimal('mrp_cost', 12, 2)->default(0);

            // 🔹 Certification & Card Details
            $table->string('certificate_id', 255)->nullable();
            $table->string('diamond_purchase_location', 255)->nullable();
            $table->string('category', 100)->nullable();
            $table->string('diamond_shape', 100)->nullable();
            $table->string('color', 10)->nullable();
            $table->string('clarity', 50)->nullable();
            $table->string('cut', 100)->nullable();
            $table->decimal('valuation', 12, 2)->default(0);
            $table->string('certificate_code', 255)->nullable();
            $table->string('diamond_image', 255)->nullable();

            // 🔹 Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
