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
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('referral_code')->unique();
            $table->decimal('commission_rate', 5, 2)->default(5.00); // percentage
            $table->decimal('balance', 15, 2)->default(0.00);
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->timestamps();
        });

        Schema::create('affiliate_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('affiliate_id')->constrained()->onDelete('cascade');
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('referrer_url')->nullable();
            $table->timestamps();
        });

        Schema::create('affiliate_commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('affiliate_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->decimal('amount', 15, 2);
            $table->enum('status', ['pending', 'approved', 'cancelled'])->default('pending');
            $table->timestamps();
        });

        Schema::create('affiliate_payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('affiliate_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->string('bank_name');
            $table->string('bank_account_number');
            $table->string('bank_account_name');
            $table->enum('status', ['pending', 'processing', 'completed', 'rejected'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Add affiliate_id to orders and bookings
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('affiliate_id')->nullable()->constrained('affiliates')->onDelete('set null');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('affiliate_id')->nullable()->constrained('affiliates')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropConstrainedForeignId('affiliate_id');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropConstrainedForeignId('affiliate_id');
        });
        Schema::dropIfExists('affiliate_payouts');
        Schema::dropIfExists('affiliate_commissions');
        Schema::dropIfExists('affiliate_visits');
        Schema::dropIfExists('affiliates');
    }
};
