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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('product_name');
            $table->string('short_note')->nullable();
            $table->string('short_description', 700)->nullable();
            $table->string('product_price');
            $table->text('large_description')->nullable();
            $table->string('dimensions', 5000)->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 1000)->nullable();
            $table->string('product_url')->nullable();
            $table->string('moq')->nullable()->comment('For corporate products');
            $table->string('list_page_img')->nullable();
            $table->json('detail_page_imgs')->nullable();
            $table->tinyInteger('product_type')->default(0)->comment("0 = Basic 1 = Corporate 2 = Wedding");
            $table->tinyInteger('is_active')->default(1)->comment("0 = Active 1 = In-active");
            $table->softDeletes();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
