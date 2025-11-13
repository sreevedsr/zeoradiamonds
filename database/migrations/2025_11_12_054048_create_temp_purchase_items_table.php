<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('temp_purchase_items', function (Blueprint $table) {
            $table->id();

            // Link to logged-in user
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            /* ================================
             * 🔹 Product Details
             * ================================ */
            $table->string('product_code')->nullable();        // Product Code *
            $table->string('item_code')->nullable();           // Item Code *
            $table->string('item_name')->nullable();           // Item Name *
            $table->integer('quantity')->default(1);           // Quantity *
            $table->decimal('gold_rate', 10, 2)->nullable();   // Gold Rate (per unit) *
            $table->decimal('gross_weight', 10, 3)->nullable();// Gross Weight (g) *
            $table->decimal('stone_weight', 10, 3)->nullable();// Stone Weight (g) *
            $table->decimal('diamond_weight', 10, 3)->nullable(); // Diamond Weight (ct) *
            $table->decimal('net_weight', 10, 3)->nullable();  // Net Weight (g)

            /* ================================
             * 🔹 Pricing & Charges
             * ================================ */
            $table->decimal('stone_amount', 12, 2)->nullable();     // Stone Amount
            $table->decimal('diamond_rate', 10, 2)->nullable();     // Diamond Rate (per carat) *
            $table->decimal('making_charge', 12, 2)->nullable();    // Making Charge
            $table->decimal('card_charge', 12, 2)->nullable();      // Card Charge
            $table->decimal('other_charge', 12, 2)->nullable();     // Other Charge
            $table->decimal('total_amount', 12, 2)->nullable();     // Total Amount (Including Gold Rate)
            $table->decimal('landing_cost', 12, 2)->nullable();     // Landing Cost
            $table->decimal('retail_percent', 5, 2)->nullable();
            $table->decimal('retail_cost', 12, 2)->nullable();
            $table->decimal('mrp_percent', 5, 2)->nullable();
            $table->decimal('mrp_cost', 12, 2)->nullable();


            /* ================================
             * 🔹 Certification & Card Details
             * ================================ */
            $table->string('certificate_id')->nullable();     // Certificate ID *
            $table->string('color')->nullable();              // Diamond Color
            $table->string('clarity')->nullable();            // Diamond Clarity
            $table->string('cut')->nullable();                // Cut
            $table->string('certificate_image')->nullable();  // Certificate Image Path
            $table->string('product_image')->nullable();      // Product Image Path

            /* ================================
             * 🔹 Optional Metadata
             * ================================ */
            $table->text('notes')->nullable(); // For extra remarks or internal tagging
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_purchase_items');
    }
};
