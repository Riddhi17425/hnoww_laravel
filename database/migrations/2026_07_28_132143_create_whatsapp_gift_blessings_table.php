<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('whatsapp_gift_blessings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blessing_id');
            $table->string('sender_name', 100);
            $table->string('receiver_name', 100);
            $table->string('receiver_phone', 15);
            $table->timestamps();

            $table->foreign('blessing_id')->references('id')->on('blessings')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('whatsapp_gift_blessings');
    }
};
