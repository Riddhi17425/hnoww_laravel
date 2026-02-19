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
        Schema::create('bespoke_commission_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone', 20)->nullable();
            $table->string('type_of_commission', 150)->nullable();;
            $table->text('customer_hoping_to_create')->nullable();
            $table->string('timeline', 100)->nullable();
            $table->string('budget', 100)->nullable();
            $table->text('additional_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bespoke_commission_enquiries');
    }
};
