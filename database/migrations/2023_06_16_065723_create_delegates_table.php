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
        Schema::create('delegates', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('image')->nullable();
            $table->text('designation')->nullable();
            $table->text('mobile')->nullable();
            $table->text('email')->nullable();
            $table->text('per_delegate')->nullable();
            $table->text('per_delegate_tax')->nullable();
            $table->text('total_delegate')->nullable();
            $table->text('type')->nullable(); // free , paid
            $table->unsignedBigInteger('delegate_reg_id')->nullable();
            $table->foreign('delegate_reg_id')->references('id')->on('deletegate_registations');
            // $table->enum('delegate_types', ['Guest', 'Speaker', 'Sponsors', 'Exhibition', 'Advertisements', 'Media_Press']); //task/lunch/dinner/breakfast
            $table->string('status')->nullable();
            $table->string('batch_assign')->nullable();
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
        Schema::dropIfExists('delegates');
    }
};
