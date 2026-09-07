<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\InstallationPackage;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Fix 7KW name
        InstallationPackage::where('category', 'Chargers & Hardware')
            ->where('name', 'like', '%7kW%')
            ->update([
                'name' => 'Amtech Original ARC 7KW Wall Box Charger compliant with International Safety Standard',
                'price' => 1290.00
            ]);

        // Insert or update 22KW
        InstallationPackage::updateOrCreate(
            [
                'category' => 'Chargers & Hardware',
                'name' => 'Amtech Original ARC 22KW Wall Box Charger compliant with International Safety Standard',
            ],
            [
                'price' => 1600.00,
                'price_unit' => 'unit',
                'description' => 'Amtech EV Wallbox 22kW 3-phase charger unit.',
                'sort_order' => 11,
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not reversing data seed
    }
};
