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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('order_number')->nullable();
            $table->string('status')->default('pending')->comment('pending', 'confirmed', 'canceled');
            $table->decimal('subtotal', 10, 2);   
            $table->decimal('order_total', 10, 2);   
            $table->string('stripe_payment_intent')->nullable();   
            $table->string('stripe_payment_intent_client_secret')->nullable();    
            $table->string('payment_status')->default('unpaid')->comment('unpaid', 'paid', 'failed')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
