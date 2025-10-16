<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('buyers', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('merchant_id')->constrained('users')->onDelete('cascade');
        $table->string('email');
        $table->string('name');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('buyers');
}

};
