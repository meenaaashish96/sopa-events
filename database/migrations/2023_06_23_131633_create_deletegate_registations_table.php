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
        Schema::create('deletegate_registations', function (Blueprint $table) {
            $table->id();
            $table->text('organization_name')->nullable();
            $table->text('GSTIN')->nullable();
            $table->text('address')->nullable();
            $table->text('city')->nullable();
            $table->text('pin_code')->nullable();
            $table->text('state')->nullable();
            $table->text('tel_phone')->nullable();
            $table->text('mobile_phone')->nullable();
            $table->text('email')->nullable();
            $table->text('country')->nullable();
            $table->json('delegate_ids')->nullable();
            $table->text('deletegate_category')->nullable();
            $table->text('grand_total')->nullable();
            $table->text('room_total')->nullable();
            $table->text('room_days')->nullable();
            $table->text('total_delegate')->nullable();
            $table->text('hotal_name')->nullable();
            $table->text('hotal_room_type')->nullable();
            $table->text('room_price')->nullable();
            $table->text('room_price_tax')->nullable();
            $table->text('room_price_unit')->nullable();
            $table->timestamp('checkin')->nullable();
            $table->timestamp('checkout')->nullable();
            $table->text('room_qty')->nullable();
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
        Schema::dropIfExists('deletegate_registations');
    }
};
