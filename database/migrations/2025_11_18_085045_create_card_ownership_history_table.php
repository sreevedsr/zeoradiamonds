<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('card_ownership_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('card_id')->constrained('cards')->cascadeOnDelete();

            $table->string('previous_owner_type')->nullable();
            $table->unsignedBigInteger('previous_owner_id')->nullable();

            $table->string('new_owner_type');
            $table->unsignedBigInteger('new_owner_id')->nullable();

            $table->foreignId('changed_by')->constrained('users');

            $table->timestamp('changed_at')->useCurrent();
            $table->index(['card_id','changed_at']);
            $table->index(['new_owner_type','new_owner_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('card_ownership_history');
    }
};
