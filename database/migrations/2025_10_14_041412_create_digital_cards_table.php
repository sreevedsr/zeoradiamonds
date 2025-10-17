<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('digital_cards', function (Blueprint $table) {
        $table->id();
        $table->json('diamond_specs');
        $table->json('jewelry_specs');
        $table->foreignId('created_by')->constrained('users');
        $table->foreignId('assigned_to')->nullable()->constrained('users');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('digital_cards');
}

};
