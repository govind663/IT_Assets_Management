<?php

namespace Database\Seeders;

use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['unit_name' => 'Volt (V)', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['unit_name' => 'Ampere (A) ', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['unit_name' => 'Ohm (Ω)', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['unit_name' => 'Watt (W)', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['unit_name' => 'Meter (m)', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['unit_name' => 'Second (s)', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['unit_name' => 'kilogram (kg)', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['unit_name' => 'kelvin (K)', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['unit_name' => 'Liter (L)', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['unit_name' => 'Centimeters (cm)', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['unit_name' => 'Gram (g)', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['unit_name' => 'Inch (in)', 'inserted_by' => 1, 'inserted_at' => Carbon::now()]
        ];

        foreach ($units as $data) {
            Unit::create($data);
        }
    }
}
