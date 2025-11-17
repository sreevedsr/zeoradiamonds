<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('cards');

        Schema::create('cards', function (Blueprint $table) {
            $table->id();

            /* --------------------------------------------------------------
             |  Foreign Keys
             --------------------------------------------------------------*/
            // $table->unsignedBigInteger('supplier_id')->nullable();
            // $table->unsignedBigInteger('staff_id')->nullable();
            // $table->unsignedBigInteger('merchant_id')->nullable();
            // $table->unsignedBigInteger('customer_id')->nullable();
            // $table->unsignedBigInteger('invoice_id')->nullable();

            // $table->foreign('supplier_id')
            //     ->references('id')
            //     ->on('suppliers')
            //     ->onDelete('set null');

            // $table->foreign('staff_id')
            //     ->references('id')
            //     ->on('users')
            //     ->onDelete('set null');

            // $table->foreign('merchant_id')
            //     ->references('id')
            //     ->on('users')
            //     ->onDelete('cascade');

            // $table->foreign('customer_id')
            //     ->references('id')
            //     ->on('customers')
            //     ->onDelete('set null');

            // $table->foreign('invoice_id')
            //     ->references('id')
            //     ->on('invoices')
            //     ->onDelete('set null');

            /* --------------------------------------------------------------
             |  Invoice Info
             --------------------------------------------------------------*/
            $table->string('invoice_no')->nullable();

            /* --------------------------------------------------------------
             |  Product Details
             --------------------------------------------------------------*/
            $table->string('product_code')->nullable();
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
            $table->string('category')->nullable();
            $table->string('diamond_shape')->nullable();
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
