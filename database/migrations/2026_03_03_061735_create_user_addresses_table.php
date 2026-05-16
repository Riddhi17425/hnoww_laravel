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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('contact_no')->nullable();  
            $table->string('emirate')->nullable();
            $table->string('address_line1', 500)->nullable(); 
            $table->string('address_line2', 500)->nullable(); 
            $table->string('landmark', 500)->nullable(); 
            $table->tinyInteger('is_primary')->default(0)->comment('1 = Primary, 0 = Not primary'); 
            $table->tinyInteger('is_confirm')->default(0)->comment('1 = Confirm, 0 = Not confirm'); 
            $table->softDeletes();
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
        Schema::dropIfExists('order_addresses');
    }
};
