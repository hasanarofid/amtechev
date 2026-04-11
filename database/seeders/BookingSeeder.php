<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\InstallationPackage;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $packageId = InstallationPackage::first()->id ?? 1;
        $month = 4; // April
        $year = 2026;

        $schedules = [
            6 => ['EV Instal', 'Site Visit'],
            7 => ['Ev Install', 'meeting'],
            8 => ['Ev Install'],
            9 => ['Site Visit'],
            10 => ['Installati'],
            11 => ['Ev Insta'],
            12 => ['Ev Charg'],
            13 => ['EV Charg'],
            14 => ['Installati'],
            15 => ['EV Instal'],
            16 => ['Ev Instal'],
            17 => ['EV Charg'],
            18 => ['Ev Insta'],
            19 => ['Ev Instal'],
            20 => ['Ev Install'],
            21 => ['Harga', 'Site Visit'],
            22 => ['EV Instal'],
            23 => ['Ev Instal'],
            25 => ['Ev Charg'],
            26 => ['Birthd'],
        ];

        $clientIndex = 1;

        foreach ($schedules as $day => $labels) {
            foreach ($labels as $label) {
                Booking::create([
                    'customer_name' => 'Client Amtech ' . $clientIndex++,
                    'phone_number' => '08123456789',
                    'email' => 'client' . $clientIndex . '@example.com',
                    'address' => 'Jl. Amtech No. ' . $day,
                    'preferred_date' => Carbon::create($year, $month, $day)->format('Y-m-d'),
                    'installation_package_id' => $packageId,
                    'status' => 'confirmed',
                    'label' => $label,
                ]);
            }
        }
    }
}
