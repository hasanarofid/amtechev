<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InstallationPackage;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate or recreate packages cleanly for seed
        InstallationPackage::query()->forceDelete();

        $packages = [
            [
                'category' => 'Standard Package',
                'name' => 'Silver Package (Essential Installation)',
                'price' => 1498.00,
                'price_3phase' => 1598.00,
                'price_unit' => null,
                'description' => 'A practical and reliable EV charging installation for homeowners looking for essential protection and professional installation.',
                'features' => [
                    'Up to 15 metres of wiring & cable installation',
                    'Himels MCB',
                    'Himels RCCB',
                    'Himels 63A Isolator',
                    '6mm SIRIM Cable',
                    'Dedicated Sub-DB Box for EV Charger',
                    '6-Month Wiring Installation Warranty'
                ],
                'addons' => [
                    ['name' => '10mm SIRIM Cable Upgrade', 'price' => 300, 'price_3phase' => 400],
                    ['name' => '6mm Mega Cable Upgrade', 'price' => 490, 'price_3phase' => 590],
                    ['name' => '10mm Mega Cable Upgrade', 'price' => 680, 'price_3phase' => 770],
                ],
                'sort_order' => 1,
            ],
            [
                'category' => 'Standard Package',
                'name' => 'Gold Package (Enhanced Protection)',
                'price' => 1680.00,
                'price_3phase' => 1880.00,
                'price_unit' => null,
                'description' => 'A step up in protection and component quality, designed for homeowners who want greater confidence in their EV charging installation.',
                'features' => [
                    'Up to 15 metres of wiring & cable installation',
                    'Himels MCB',
                    'Terasaki RCCB',
                    'Himels 63A Isolator',
                    '6mm SIRIM Cable',
                    'Dedicated Sub-DB Box for EV Charger',
                    '1-Year Wiring Installation Warranty'
                ],
                'addons' => [
                    ['name' => '10mm SIRIM Cable Upgrade', 'price' => 250, 'price_3phase' => 350],
                    ['name' => '6mm Mega Cable Upgrade', 'price' => 450, 'price_3phase' => 550],
                    ['name' => '10mm Mega Cable Upgrade', 'price' => 650, 'price_3phase' => 750],
                ],
                'sort_order' => 2,
            ],
            [
                'category' => 'Standard Package',
                'name' => 'Diamond Package (Premium Heavy-Duty)',
                'price' => 2098.00,
                'price_3phase' => 2298.00,
                'price_unit' => null,
                'description' => 'NO COMPROMISE. BUILT TO LAST. Premium installation package built with Schneider Electric components and Mega Cable.',
                'features' => [
                    'Up to 15 metres of wiring & cable installation',
                    'Schneider Electric MCB',
                    'Schneider Electric RCCB',
                    'Schneider Electric 63A Isolator',
                    '6mm Mega Cable',
                    'Dedicated Sub-DB Box for EV Charger',
                    '3-Year Wiring Installation Warranty'
                ],
                'addons' => [
                    ['name' => '10mm Mega Cable Upgrade', 'price' => 400, 'price_3phase' => 500],
                ],
                'sort_order' => 3,
            ],
            [
                'category' => 'Cable Upgrade',
                'name' => '6mm Mega Cable Upgrade',
                'price' => 490.00,
                'price_3phase' => 590.00,
                'price_unit' => null,
                'description' => 'Upgrade standard SIRIM cable to heavy-duty 6mm Mega Cable.',
                'sort_order' => 4,
            ],
            [
                'category' => 'Cable Upgrade',
                'name' => '10mm Mega Cable Upgrade',
                'price' => 680.00,
                'price_3phase' => 770.00,
                'price_unit' => null,
                'description' => 'Upgrade standard cable to maximum heavy-duty 10mm Mega Cable.',
                'sort_order' => 5,
            ],
            [
                'category' => 'Routing & Wiring',
                'name' => 'Additional 6mm SIRIM Cable (Beyond 15m)',
                'price' => 70.00,
                'price_3phase' => null,
                'price_unit' => 'meter',
                'description' => 'Rate for additional 6mm SIRIM cable per meter beyond included 15m.',
                'sort_order' => 6,
            ],
            [
                'category' => 'Routing & Wiring',
                'name' => 'Additional 10mm SIRIM Cable (Beyond 15m)',
                'price' => 100.00,
                'price_3phase' => null,
                'price_unit' => 'meter',
                'description' => 'Rate for additional 10mm SIRIM cable per meter beyond included 15m.',
                'sort_order' => 7,
            ],
            [
                'category' => 'Routing & Wiring',
                'name' => 'Additional 6mm Mega Cable (Beyond 15m)',
                'price' => 100.00,
                'price_3phase' => null,
                'price_unit' => 'meter',
                'description' => 'Rate for additional 6mm Mega cable per meter beyond included 15m.',
                'sort_order' => 8,
            ],
            [
                'category' => 'Routing & Wiring',
                'name' => 'Additional 10mm Mega Cable (Beyond 15m)',
                'price' => 160.00,
                'price_3phase' => null,
                'price_unit' => 'meter',
                'description' => 'Rate for additional 10mm Mega cable per meter beyond included 15m.',
                'sort_order' => 9,
            ],
            [
                'category' => 'Chargers & Hardware',
                'name' => 'AMTECH EV Wallbox 7kW',
                'price' => 1200.00,
                'price_3phase' => null,
                'price_unit' => 'unit',
                'description' => 'Amtech EV Wallbox 7kW charger unit.',
                'sort_order' => 10,
            ],
            [
                'category' => 'Chargers & Hardware',
                'name' => 'AMTECH EV Wallbox 22kW',
                'price' => 1600.00,
                'price_3phase' => null,
                'price_unit' => 'unit',
                'description' => 'Amtech EV Wallbox 22kW 3-phase charger unit.',
                'sort_order' => 11,
            ],
            [
                'category' => 'Chargers & Hardware',
                'name' => 'Amtech 3.5kW Granny Charger',
                'price' => 550.00,
                'price_3phase' => null,
                'price_unit' => 'unit',
                'description' => 'Portable 3.5kW Granny Charger.',
                'sort_order' => 12,
            ],
        ];

        foreach ($packages as $package) {
            InstallationPackage::create($package);
        }
    }
}
