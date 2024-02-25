<?php

namespace Database\Seeders;

use App\Models\Catagories;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatagorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catagories = [
            ['catagories_name' => 'Keyboard', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['catagories_name' => 'Monitor', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['catagories_name' => 'Hard Drive', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['catagories_name' => 'Power Supplies', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['catagories_name' => 'Input Devices', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['catagories_name' => 'Memory', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['catagories_name' => 'Accessories', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['catagories_name' => 'Cables', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['catagories_name' => 'Cooling Fan', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['catagories_name' => 'Desktop', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['catagories_name' => 'Memory Cards', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['catagories_name' => 'Microphones', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['catagories_name' => 'Motherboard', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['catagories_name' => 'Scanner', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['catagories_name' => 'Tablet', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['catagories_name' => 'Mouse & Mouse pad', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['catagories_name' => 'Case', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
            ['catagories_name' => 'Printer', 'inserted_by' => 1, 'inserted_at' => Carbon::now()],
        ];

        foreach ($catagories as $data) {
            Catagories::create($data);
        }
    }
}
