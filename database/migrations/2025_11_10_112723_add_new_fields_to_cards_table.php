<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cards', function (Blueprint $table) {
            // Invoice and Staff Details
            $table->string('invoice_no')->nullable()->after('invoice_id');
            $table->date('date')->nullable()->after('invoice_no');

            // Link supplier to suppliers table
            $table->unsignedBigInteger('supplier_id')->nullable()->after('date');
            $table->foreign('supplier_id')
                  ->references('id')
                  ->on('suppliers')
                  ->onDelete('set null');

            // Link staff to users table
            $table->unsignedBigInteger('staff_id')->nullable()->after('supplier_id');
            $table->foreign('staff_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');

            // Product Details
            $table->string('product_code')->nullable()->after('staff_id');
            $table->string('item_code')->nullable()->after('product_code');
            $table->string('item_name')->nullable()->after('item_code');
            $table->integer('quantity')->default(1)->after('item_name');

            // Gold and Diamond Rates
            $table->decimal('gold_rate', 10, 2)->nullable()->after('quantity');
            $table->decimal('diamond_rate', 10, 2)->nullable()->after('gold_rate');

            // Weights (in grams)
            $table->decimal('gross_weight', 10, 3)->default(0)->after('diamond_rate');
            $table->decimal('stone_weight', 10, 3)->default(0)->after('gross_weight');
            $table->decimal('diamond_weight', 10, 3)->default(0)->after('stone_weight');
            $table->decimal('net_weight', 10, 3)->default(0)->after('diamond_weight');

            // Charges and Cost Details
            $table->decimal('stone_amount', 10, 2)->default(0)->after('net_weight');
            $table->decimal('making_charge', 10, 2)->default(0)->after('stone_amount');
            $table->decimal('card_charge', 10, 2)->default(0)->after('making_charge');
            $table->decimal('other_charge', 10, 2)->default(0)->after('card_charge');
            $table->decimal('landing_cost', 10, 2)->default(0)->after('other_charge');
            $table->decimal('retail_cost_percent', 5, 2)->default(0)->after('landing_cost');
            $table->decimal('mrp_cost_percent', 5, 2)->default(0)->after('retail_cost_percent');
            $table->decimal('total_amount', 12, 2)->default(0)->after('mrp_cost_percent');

            // Certificate and Images
            $table->string('certificate_image')->nullable()->after('total_amount');
            $table->string('product_image')->nullable()->after('certificate_image');
        });
    }

    public function down(): void
    {
        Schema::table('cards', function (Blueprint $table) {
            // Drop foreign keys first
            $table->dropForeign(['supplier_id']);
            $table->dropForeign(['staff_id']);

            // Then drop columns
            $table->dropColumn([
                'invoice_no',
                'date',
                'supplier_id',
                'staff_id',
                'product_code',
                'item_code',
                'item_name',
                'quantity',
                'gold_rate',
                'diamond_rate',
                'gross_weight',
                'stone_weight',
                'diamond_weight',
                'net_weight',
                'stone_amount',
                'making_charge',
                'card_charge',
                'other_charge',
                'landing_cost',
                'retail_cost_percent',
                'mrp_cost_percent',
                'total_amount',
                'certificate_image',
                'product_image',
            ]);
        });
    }
};
