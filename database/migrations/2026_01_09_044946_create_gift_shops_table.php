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
        Schema::create('gift_shops', function (Blueprint $table) {
            $table->id();
            $table->string('gift_for')->nullable();
            $table->string('to_celebrate')->nullable();
            $table->string('product_name');
            $table->string('short_description', 700)->nullable();
            $table->string('product_price');
            $table->text('large_description')->nullable();
            $table->string('dimensions', 5000)->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 1000)->nullable();
            $table->string('product_url')->nullable();
            $table->string('list_page_img')->nullable();
            $table->json('detail_page_imgs')->nullable();
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
        Schema::dropIfExists('gift_shops');
    }
};
