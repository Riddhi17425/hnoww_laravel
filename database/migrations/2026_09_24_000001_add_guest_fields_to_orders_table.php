<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->string('guest_email')->nullable()->after('user_id');
            $table->timestamp('guest_email_verified_at')->nullable()->after('guest_email');
            $table->string('guest_order_token')->nullable()->after('guest_email_verified_at');
            $table->timestamp('guest_order_token_expires_at')->nullable()->after('guest_order_token');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['guest_email', 'guest_email_verified_at', 'guest_order_token', 'guest_order_token_expires_at']);
        });
    }
};
