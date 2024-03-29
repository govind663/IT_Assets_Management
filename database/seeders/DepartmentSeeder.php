<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create([
            'dept_name' => 'IT Department',
            'dep_code' => 'IT',
            'inserted_by' => '1',
            'inserted_at' => Carbon::now()
        ]);

        Department::create([
            'dept_name' => 'Public Works Department',
            'dep_code' => 'PWD',
            'inserted_by' => '1',
            'inserted_at' => Carbon::now()
        ]);

    }
}
