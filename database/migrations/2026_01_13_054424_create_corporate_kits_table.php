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
        Schema::create('corporate_kits', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('short_description', 500)->nullable();
            $table->string('large_description', 1500)->nullable();
            $table->string('image')->nullable();
            $table->string('price_range')->nullable();
            $table->string('moq')->nullable();
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
        Schema::dropIfExists('corporate_kits');
    }
};
