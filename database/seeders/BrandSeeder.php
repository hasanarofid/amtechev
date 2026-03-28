<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'Terasaki', 'logo' => 'brands/terasaki.png', 'sort_order' => 1],
            ['name' => 'Schneider', 'logo' => 'brands/schneider.png', 'sort_order' => 2],
            ['name' => 'ABB', 'logo' => 'brands/abb.png', 'sort_order' => 3],
        ];

        foreach ($brands as $brand) {
            Brand::updateOrCreate(['name' => $brand['name']], $brand);
        }
    }
}
