<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempSalesTable extends Migration
{
    public function up()
    {
        Schema::create('temp_sales', function (Blueprint $table) {
            $table->id();

            // minimal required fields for sale item
            $table->unsignedBigInteger('card_id')->nullable()->index();     // card row (if you're assigning a card)
            $table->string('barcode')->nullable();
            $table->string('product_code')->nullable();
            $table->string('item_code')->nullable();
            $table->string('item_name')->nullable();
            $table->string('hsn')->nullable();

            $table->decimal('quantity', 10, 2)->default(1);
            $table->decimal('gross_weight', 12, 3)->default(0);
            $table->decimal('stone_weight', 12, 3)->default(0);
            $table->decimal('diamond_weight', 12, 3)->default(0);
            $table->decimal('net_weight', 12, 3)->default(0);

            $table->decimal('net_amount', 15, 2)->default(0);
            $table->decimal('cgst', 12, 2)->default(0);
            $table->decimal('sgst', 12, 2)->default(0);
            $table->decimal('igst', 12, 2)->default(0);
            $table->decimal('total_amount', 15, 2)->default(0);

            $table->unsignedBigInteger('merchant_id')->nullable()->index();
            $table->unsignedBigInteger('created_by')->nullable()->index();

            $table->timestamps();

            // foreign keys are optional; add if you have users/merchants/cards tables
            // $table->foreign('merchant_id')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('card_id')->references('id')->on('cards')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('temp_sales');
    }
}
