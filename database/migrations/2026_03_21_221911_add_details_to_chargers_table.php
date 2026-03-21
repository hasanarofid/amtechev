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
        Schema::table('chargers', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name')->nullable();
            $table->json('images')->nullable()->after('image_url');
            $table->text('specifications')->nullable();
            $table->text('product_info')->nullable();
            $table->text('installation_info')->nullable();
            $table->text('why_choose_us')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chargers', function (Blueprint $table) {
            $table->dropColumn(['slug', 'images', 'specifications', 'product_info', 'installation_info', 'why_choose_us']);
        });
    }
};
