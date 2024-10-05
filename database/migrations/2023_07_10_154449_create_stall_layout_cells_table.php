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
        Schema::create('stall_layout_cells', function (Blueprint $table) {
            $table->id();
            $table->text('call')->nullable();
            $table->text('stall_number')->nullable();
            $table->unsignedBigInteger('stall_id')->nullable();
            $table->foreign('stall_id')->references('id')->on('stalls');
            $table->unsignedBigInteger('layout_id')->nullable();
            $table->foreign('layout_id')->references('id')->on('stall_layouts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stall_layout_cells');
    }
};
