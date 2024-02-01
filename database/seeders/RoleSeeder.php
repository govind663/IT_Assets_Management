<?php

namespace Database\Seeders;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'role_name' => 'Admin',
            'inserted_by' => '1',
            'inserted_at' => Carbon::now()
        ]);

        Role::create([
            'role_name' => 'HOD',
            'inserted_by' => '1',
            'inserted_at' => Carbon::now()
        ]);

        Role::create([
            'role_name' => 'Clerk',
            'inserted_by' => '1',
            'inserted_at' => Carbon::now()
        ]);
    }
}
