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
            ['name' => 'Proton E.Mas', 'logo' => 'brands/proton.png', 'sort_order' => 3],
            ['name' => 'MG', 'logo' => 'brands/mg.png', 'sort_order' => 4],
            ['name' => 'GWM', 'logo' => 'brands/gwm.png', 'sort_order' => 5],
            ['name' => 'Zeekr', 'logo' => 'brands/zeekr.png', 'sort_order' => 6],
            ['name' => 'Leapmotor', 'logo' => 'brands/leapmotor.png', 'sort_order' => 7],
            ['name' => 'Xpeng', 'logo' => 'brands/xpeng.png', 'sort_order' => 8],
            ['name' => 'Chery', 'logo' => 'brands/chery.png', 'sort_order' => 9],
            ['name' => 'Denza', 'logo' => 'brands/denza.png', 'sort_order' => 10],
            ['name' => 'DongFeng', 'logo' => 'brands/dongfeng.png', 'sort_order' => 11],
            ['name' => 'BMW', 'logo' => 'brands/bmw.png', 'sort_order' => 12],
            ['name' => 'Mercedes Benz', 'logo' => 'brands/mercedes.png', 'sort_order' => 13],
            ['name' => 'Volvo', 'logo' => 'brands/volvo.png', 'sort_order' => 14],
            ['name' => 'Terasaki', 'logo' => 'brands/terasaki.png', 'sort_order' => 15],
            ['name' => 'Schneider', 'logo' => 'brands/schneider.png', 'sort_order' => 16],
            ['name' => 'ABB', 'logo' => 'brands/abb.png', 'sort_order' => 17],
        ];

        foreach ($brands as $brand) {
            Brand::updateOrCreate(['name' => $brand['name']], $brand);
        }
    }
}
