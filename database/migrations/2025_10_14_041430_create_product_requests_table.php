<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('product_requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('merchant_id')->constrained('users');
        $table->enum('status', ['pending','approved','rejected'])->default('pending');
        $table->json('details');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('product_requests');
}

};
