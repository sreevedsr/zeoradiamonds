<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('activity_logs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users');
        $table->string('role');
        $table->string('action_type');
        $table->unsignedBigInteger('reference_id'); // card/request ID
        $table->json('previous_state')->nullable();
        $table->json('new_state')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('activity_logs');
}

};
