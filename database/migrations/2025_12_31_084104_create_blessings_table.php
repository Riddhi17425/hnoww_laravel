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
        Schema::create('blessings', function (Blueprint $table) {
            $table->id();
            $table->string('blessing_of', 500)->nullable();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('description', 500)->nullable();
            $table->string('image')->nullable();
            $table->string('audio_content', 700)->nullable();
            $table->string('audio_file')->nullable();
            $table->tinyInteger('is_active')->default(1)->comment("0 = Active 1 = In-active");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blessings');
    }
};
