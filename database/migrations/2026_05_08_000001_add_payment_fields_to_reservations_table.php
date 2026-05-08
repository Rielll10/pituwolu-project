<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('order_id')->nullable()->unique()->after('id');
            $table->string('snap_token')->nullable()->after('total_price');
            $table->enum('payment_status', ['unpaid', 'pending', 'paid', 'failed', 'expired'])->default('unpaid')->after('snap_token');
            $table->string('payment_type')->nullable()->after('payment_status');
            $table->string('transaction_id')->nullable()->after('payment_type');
            $table->timestamp('paid_at')->nullable()->after('transaction_id');
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['order_id', 'snap_token', 'payment_status', 'payment_type', 'transaction_id', 'paid_at']);
        });
    }
};
