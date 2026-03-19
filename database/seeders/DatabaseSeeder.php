<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Package;
use App\Models\Trainer;
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
        // 1. Seed Packages
        $starter = Package::updateOrCreate(['name' => 'Starter'], [
            'price' => 250000,
            'duration_days' => 30,
            'description' => 'Perfect for beginners looking to start their fitness journey.',
            'status' => true,
        ]);

        $pro = Package::updateOrCreate(['name' => 'Pro'], [
            'price' => 650000,
            'duration_days' => 90,
            'description' => 'Advanced features and personal training sessions included.',
            'status' => true,
        ]);

        $elite = Package::updateOrCreate(['name' => 'Elite'], [
            'price' => 2000000,
            'duration_days' => 365,
            'description' => 'Full access to all facilities and premium services for a year.',
            'status' => true,
        ]);

        // 2. Seed Admin
        User::updateOrCreate(['email' => 'admin@amtech.com'], [
            'name' => 'Master Admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => true,
        ]);

        // 3. Seed Staff (Petugas)
        User::updateOrCreate(['email' => 'staff@amtech.com'], [
            'name' => 'amtech Staff',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'status' => true,
        ]);

        // 4. Seed Member
        $memberUser = User::updateOrCreate(['email' => 'member@amtech.com'], [
            'name' => 'John Member',
            'password' => Hash::make('password'),
            'role' => 'member',
            'status' => true,
        ]);

        // Create membership for the seeded member
        $memberUser->membership()->updateOrCreate(['user_id' => $memberUser->id], [
            'package_id' => $starter->id,
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'status' => 'active',
        ]);

        // 5. Seed Trainers
        $hercules = Trainer::updateOrCreate(['name' => 'Coach Hercules'], [
            'specialty' => 'Bodybuilding & Strength',
            'image_url' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=2070',
            'status' => true,
        ]);

        $athena = Trainer::updateOrCreate(['name' => 'Coach Athena'], [
            'specialty' => 'Yoga & Flexibility',
            'image_url' => 'https://images.unsplash.com/photo-1518611012118-29621e25e83c?q=80&w=2070',
            'status' => true,
        ]);

        // 6. Seed Gym Classes
        \App\Models\GymClass::updateOrCreate(['name' => 'Power Lifting'], [
            'description' => 'Master the big three: Squat, Bench, and Deadlift.',
            'trainer_id' => $hercules->id,
            'day_of_week' => 'Monday',
            'start_time' => '08:00:00',
            'end_time' => '09:30:00',
            'capacity' => 15,
            'status' => 'scheduled',
        ]);

        \App\Models\GymClass::updateOrCreate(['name' => 'Morning Zen'], [
            'description' => 'A calming yoga session to start your day.',
            'trainer_id' => $athena->id,
            'day_of_week' => 'Wednesday',
            'start_time' => '07:00:00',
            'end_time' => '08:00:00',
            'capacity' => 20,
            'status' => 'scheduled',
        ]);

        \App\Models\GymClass::updateOrCreate(['name' => 'Core Crusher'], [
            'description' => 'Intense abdominal and core stability workout.',
            'trainer_id' => $hercules->id,
            'day_of_week' => 'Friday',
            'start_time' => '17:00:00',
            'end_time' => '18:00:00',
            'capacity' => 25,
            'status' => 'scheduled',
        ]);
    }
}
