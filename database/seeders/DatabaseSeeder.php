<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Admin
        User::updateOrCreate(['email' => 'admin@amtech.com'], [
            'name' => 'Master Admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => true,
        ]);

        // 2. Seed Staff
        User::updateOrCreate(['email' => 'staff@amtech.com'], [
            'name' => 'Amtech Staff',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'status' => true,
        ]);

        // 3. Seed Member / Customer
        User::updateOrCreate(['email' => 'member@amtech.com'], [
            'name' => 'John Customer',
            'password' => Hash::make('password'),
            'role' => 'member',
            'status' => true,
        ]);

        // 4. Landing Page Content
        $this->call(LandingPageSeeder::class);
    }
}
