<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('festival_inquiries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('name');
            $table->string('company_name')->nullable();
            $table->string('product_name')->nullable();
            $table->json('product_of_interest')->nullable();
            $table->string('quantity_range')->nullable();
            $table->string('budget')->nullable();
            $table->string('branding_requirements')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('email');
            $table->string('contact_no')->nullable();
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('festival_inquiries');
    }
};