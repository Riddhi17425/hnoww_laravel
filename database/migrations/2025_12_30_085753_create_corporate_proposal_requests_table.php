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
        Schema::create('corporate_proposal_requests', function (Blueprint $table) {
            $table->id();
            // $table->string('full_name', 100);
            // $table->string('company_name', 150);
            // $table->string('phone', 20);
            // $table->string('email', 150);
            // $table->json('product_of_interest')->nullable(); // JSON to store multiple selected products
            // $table->string('quantity_range', 20)->nullable();
            // $table->string('budget', 100)->nullable();
            // $table->string('branding_requirements', 255)->nullable();
            // $table->date('delivery_date')->nullable();
            // $table->text('message')->nullable();
            $table->string('full_name', 100);
            $table->string('company_name', 150);
            $table->string('role', 100);
            $table->string('email', 150);
            $table->string('phone', 20)->nullable();
            $table->json('nature_of_requirement')->nullable(); // JSON to store multiple selected requirements
            $table->string('quantity_range', 20)->nullable();
            $table->string('corporate_budget', 100)->nullable();
            $table->string('timeline', 100)->nullable();
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corporate_proposal_requests');
    }
};
