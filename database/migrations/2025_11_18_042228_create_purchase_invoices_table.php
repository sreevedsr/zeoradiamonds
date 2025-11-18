<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_invoices', function (Blueprint $table) {
            $table->id();

            // Invoice details
            $table->string('invoice_no')->unique();
            $table->date('invoice_date');

            // Supplier
            $table->unsignedBigInteger('supplier_id')->nullable();

            $table->timestamps();
        });

        // Add foreign key later in cards table
        Schema::table('cards', function (Blueprint $table) {
            $table->unsignedBigInteger('purchase_invoice_id')->nullable()->after('id');

            $table->foreign('purchase_invoice_id')
                ->references('id')
                ->on('purchase_invoices')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->dropForeign(['purchase_invoice_id']);
            $table->dropColumn('purchase_invoice_id');
        });

        Schema::dropIfExists('purchase_invoices');
    }
};
