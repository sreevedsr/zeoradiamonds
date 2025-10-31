<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merchant_id'); // 🔹 Foreign key to merchants/users table
            $table->string('name');                    // Required
            $table->string('email')->unique();         // Required
            $table->string('phone');                   // Required
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();

            // 🔹 Add foreign key constraint
            $table->foreign('merchant_id')
                ->references('id')
                ->on('users') // assuming merchants are stored in users table
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
