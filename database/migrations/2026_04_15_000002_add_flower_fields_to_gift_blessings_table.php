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
        Schema::table('gift_blessings', function (Blueprint $table) {
            $table->boolean('add_flowers')->default(false)->after('landmark');
            $table->string('flower_budget_range', 50)->nullable()->after('add_flowers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gift_blessings', function (Blueprint $table) {
            $table->dropColumn(['add_flowers', 'flower_budget_range']);
        });
    }
};