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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('image')->nullable();
            $table->text('location')->nullable();
            $table->json('speackers')->nullable();
            $table->json('points')->nullable();
            $table->text('description')->nullable();
            $table->time('to_time');
            $table->time('from_time');
            $table->date('schedule_date');
            $table->string('status')->nullable();
            $table->enum('type', ['task', 'lunch', 'dinner', 'breakfast']); //task/lunch/dinner/breakfast
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('event_id')->nullable();
            $table->foreign('event_id')->references('id')->on('events');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
