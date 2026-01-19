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
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->String('month_name')->nullable();
            $table->String('title')->nullable();
            $table->String('description', 2000)->nullable();
            $table->String('image')->nullable();
            $table->tinyInteger('is_active')->default(1)->comment("0 = Active 1 = In-active");
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journals');
    }
};
