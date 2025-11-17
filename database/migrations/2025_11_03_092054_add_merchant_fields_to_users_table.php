<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('merchant_code')->nullable()->unique();
            $table->string('state_code')->nullable();
            $table->string('state')->nullable();
            $table->string('gst_no')->nullable()->unique();

            // New fields
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove added fields only
            $table->dropColumn(['merchant_code', 'state_code', 'state', 'gst_no', 'phone', 'address']);
        });
    }
};
