<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'category' => 'Standard Package',
                'name' => 'STANDARD INSTALLATION PACKAGE',
                'price' => 898.00,
                'price_unit' => null,
                'features' => [
                    'Direct connection',
                    'MCB',
                    'RCCB',
                    'Isolator Switch',
                    '1 year warranty',
                    'Free Site Inspection (Selangor & KL only)'
                ],
                'sort_order' => 1,
            ],
            [
                'category' => 'Routing & Wiring',
                'name' => 'Routing hole',
                'price' => 150.00,
                'price_unit' => 'hole',
                'description' => '(including 2 meter wire)',
                'sort_order' => 2,
            ],
            [
                'category' => 'Routing & Wiring',
                'name' => 'Wire routing 6mm²',
                'price' => 100.00,
                'price_unit' => 'meter',
                'sort_order' => 3,
            ],
            [
                'category' => 'Routing & Wiring',
                'name' => 'Wire routing 10mm²',
                'price' => 150.00,
                'price_unit' => 'meter',
                'sort_order' => 4,
            ],
            [
                'category' => 'Electrical Checking',
                'name' => '3 Phase Incoming Power Supply Checking',
                'price' => 150.00,
                'price_unit' => null,
                'sort_order' => 5,
            ],
            [
                'category' => 'Electrical Checking',
                'name' => 'Grounding checking',
                'price' => 150.00,
                'price_unit' => null,
                'sort_order' => 6,
            ],
            [
                'category' => 'Grounding Works',
                'name' => 'Upgrade grounding (3 spike)',
                'price' => 800.00,
                'price_unit' => null,
                'sort_order' => 7,
            ],
            [
                'category' => 'Grounding Works',
                'name' => 'Additional grounding rod',
                'price' => 100.00,
                'price_unit' => 'rod',
                'description' => '(if more than 3 rods required)',
                'sort_order' => 8,
            ],
            [
                'category' => 'Extended Warranty',
                'name' => 'Additional 1 Year Warranty',
                'price' => 190.00,
                'price_unit' => 'year',
                'sort_order' => 9,
            ],
            [
                'category' => 'Extended Warranty',
                'name' => 'Maximum coverage up to 5 Years',
                'price' => 0.00,
                'price_unit' => null,
                'sort_order' => 10,
            ],
        ];

        foreach ($packages as $package) {
            \App\Models\InstallationPackage::create($package);
        }
    }
}
