<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('scans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('delegate_id');
            $table->enum('meal_type', ['lunch', 'dinner', 'breakfast']); // Ensure the column exists here
            $table->timestamp('scanned_at');
            $table->timestamps();

            $table->foreign('delegate_id')->references('id')->on('delegates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scans');
    }
};
