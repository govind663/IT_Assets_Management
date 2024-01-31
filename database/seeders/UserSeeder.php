<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'role_id' => '1',
            'department_id' => '1',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1234567890'),
            'created_by' => '1',
            'created_at' => Carbon::now()
        ]);

        User::create([
            'name' => 'HOD',
            'role_id' => '2',
            'department_id' => '1',
            'email' => 'hod@gmail.com',
            'password' => Hash::make('1234567890'),
            'created_by' => '2',
            'created_at' => Carbon::now()
        ]);

        User::create([
            'name' => 'Cleark',
            'role_id' => '3',
            'department_id' => '1',
            'email' => 'cleark@gmail.com',
            'password' => Hash::make('1234567890'),
            'created_by' => '3',
            'created_at' => Carbon::now()
        ]);
    }
}
