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
        Schema::dropIfExists('check_ins');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('memberships');
        Schema::dropIfExists('gym_classes');
        Schema::dropIfExists('trainers');
        Schema::dropIfExists('packages');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
