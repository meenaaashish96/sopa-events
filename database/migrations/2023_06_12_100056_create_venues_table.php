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
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('address');
            $table->text('location');
            $table->text('city');
            $table->text('state')->nullable();
            $table->text('country')->nullable();
            $table->text('image')->nullable();
            $table->text('pincode')->nullable();
            $table->text('lat')->nullable();
            $table->text('long')->nullable();
            $table->text('airport')->nullable();
            $table->text('railway')->nullable();
            $table->text('contact_no1')->nullable();
            $table->text('contact_no2')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('venues');
    }
};
