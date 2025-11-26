<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_sales_invoices', function (Blueprint $table) {
            $table->id();

            // Unique product code for each sale
            $table->string('product_code')->unique();

            // Merchant receiving the sale
            $table->unsignedBigInteger('merchant_id');

            // Staff who handled the sale
            $table->unsignedBigInteger('staff_id')->nullable();

            // Optional: if admin wants invoice number
            $table->string('invoice_no')->nullable();

            // Date of sale
            $table->date('sale_date');

            // Amount
            $table->decimal('amount', 12, 2)->default(0);

            // Description / Notes (optional)
            $table->text('notes')->nullable();

            $table->timestamps();

            // Relationship with users (merchant)
            $table->foreign('merchant_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            // Relationship with staff
            $table->foreign('staff_id')
                ->references('id')
                ->on('staff')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_sales_invoices');
    }
};
