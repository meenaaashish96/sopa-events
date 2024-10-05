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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->text('grand_total')->nullable();
            $table->text('ref_type')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('ref_id')->nullable();
            $table->text('UTR_number')->nullable();
            $table->text('Cheque_receipt_number')->nullable();
            $table->text('payment_status')->nullable();
            $table->text('payment_recevied')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->enum('payment_mode', ['offline', 'online']); 
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
        Schema::dropIfExists('transactions');
    }
};
