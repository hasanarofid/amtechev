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
        Schema::create('booking_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->foreignId('installation_package_id')->constrained();
            $table->integer('quantity')->default(1);
            $table->decimal('price_at_booking', 10, 2);
            $table->timestamps();
        });

        // Add total_price to bookings table and make installation_package_id nullable
        Schema::table('bookings', function (Blueprint $table) {
            $table->decimal('total_price', 10, 2)->default(0)->after('notes');
            $table->foreignId('installation_package_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_items');

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('total_price');
            $table->foreignId('installation_package_id')->nullable(false)->change();
        });
    }
};
