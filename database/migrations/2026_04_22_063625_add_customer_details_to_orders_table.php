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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('customer_first_name')->nullable();
            $table->string('customer_last_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->text('customer_address')->nullable();
            $table->string('customer_city')->nullable();
            $table->string('customer_postcode')->nullable();
            $table->string('customer_state')->nullable();
            $table->string('customer_country')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('pending');
            $table->string('bayarcash_transaction_id')->nullable();
            $table->text('payment_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'customer_first_name',
                'customer_last_name',
                'customer_email',
                'customer_phone',
                'customer_address',
                'customer_city',
                'customer_postcode',
                'customer_state',
                'customer_country',
                'payment_method',
                'payment_status',
                'bayarcash_transaction_id',
                'payment_url'
            ]);
        });
    }
};
