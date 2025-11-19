<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('card_ownerships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('card_id')->constrained('cards')->cascadeOnDelete();
            $table->enum('owner_type', ['admin','merchant','customer']);
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->timestamps();

            $table->unique('card_id', 'card_ownerships_card_unique');
            $table->index(['owner_type','owner_id'], 'card_ownerships_owner_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('card_ownerships');
    }
};
