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
            $table->string('product_code')->unique();
            $table->foreignId('card_id')->constrained('cards')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('temp_sales');
    }
}
