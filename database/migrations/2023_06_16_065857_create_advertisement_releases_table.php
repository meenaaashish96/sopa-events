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
        Schema::create('advertisement_releases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('delegate_reg_id')->nullable();
            $table->unsignedBigInteger('advertisement_id')->nullable();
            $table->text('file')->nullable();
            $table->text('amount')->nullable();
            $table->text('tax')->nullable();
            $table->text('advertisement_total')->nullable();
            $table->text('grand_total')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('advertisement_id')->references('id')->on('advertisements');
            $table->foreign('delegate_reg_id')->references('id')->on('deletegate_registations');
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
        Schema::dropIfExists('advertisement_releases');
    }
};
