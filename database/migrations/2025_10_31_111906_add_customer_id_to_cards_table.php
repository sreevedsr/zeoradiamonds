<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void
    {
        Schema::table('cards', function (Blueprint $table) {
            // Customer reference
            $table->unsignedBigInteger('customer_id')->nullable()->after('merchant_id');

            $table->decimal('valuation', 10, 2)->nullable()->after('customer_id');
            $table->decimal('price', 10, 2)->nullable()->after('valuation');
            $table->decimal('discount', 5, 2)->nullable()->default(0)->after('price');
            $table->decimal('final_price', 10, 2)->nullable()->after('discount');

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropColumn(['customer_id', 'valuation', 'price', 'discount', 'final_price']);
        });
    }
};
