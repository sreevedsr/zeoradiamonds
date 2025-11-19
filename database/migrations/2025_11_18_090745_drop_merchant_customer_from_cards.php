<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cards', function (Blueprint $table) {
            if (Schema::hasColumn('cards', 'merchant_id')) {
                $table->dropIndex(['merchant_id']);
                $table->dropColumn('merchant_id');
            }
            if (Schema::hasColumn('cards', 'customer_id')) {
                $table->dropColumn('customer_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->unsignedBigInteger('merchant_id')->nullable()->after('final_price');
            $table->unsignedBigInteger('customer_id')->nullable()->after('merchant_id');
            $table->index('merchant_id');
        });
    }
};
