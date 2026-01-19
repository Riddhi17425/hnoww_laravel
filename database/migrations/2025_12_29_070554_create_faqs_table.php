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
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('faq_type_id');
            $table->string('question')->nullable();
            $table->text('answer')->nullable();
            $table->tinyInteger('is_active')->default(1)->comment("0 = Active 1 = In-active");
            $table->softDeletes();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('faq_type_id')->references('id')->on('faq_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
