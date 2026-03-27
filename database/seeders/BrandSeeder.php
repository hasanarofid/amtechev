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
            ['name' => 'BYD', 'logo' => 'brands/byd.png', 'sort_order' => 1],
            ['name' => 'Tesla', 'logo' => 'brands/tesla.png', 'sort_order' => 2],
            ['name' => 'E.MAS', 'logo' => 'brands/emas.png', 'sort_order' => 3],
        ];

        foreach ($brands as $brand) {
            Brand::updateOrCreate(['name' => $brand['name']], $brand);
        }
    }
}
