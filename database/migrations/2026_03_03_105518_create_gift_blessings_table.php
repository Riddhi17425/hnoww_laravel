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
        Schema::create('gift_blessings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blessing_id');
            $table->string('from_name')->nullable();
            $table->string('from_email')->nullable();
            $table->string('from_phone')->nullable();
            $table->string('to_name')->nullable();
            $table->string('to_email')->nullable();
            $table->string('to_phone')->nullable();
            $table->string('emirate')->nullable();
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('landmark', 500)->nullable();
            $table->string('message_note', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gift_blessings');
    }
};
