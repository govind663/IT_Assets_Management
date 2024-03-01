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
            'f_name' => 'Admin',
            'm_name' => 'M',
            'l_name' => 'L',
            'role_id' => '1',
            'department_id' => '1',
            'gender' => '1',
            'email' => 'admin@gmail.com',
            'phone_number' => '1234567890',
            'password' => Hash::make('1234567890'),
            'created_by' => '1',
            'created_at' => Carbon::now()
        ]);

        User::create([
            'f_name' => 'HOD',
            'm_name' => 'M',
            'l_name' => 'L',
            'role_id' => '2',
            'department_id' => '1',
            'email' => 'hod@gmail.com',
            'phone_number' => '1234565890',
            'password' => Hash::make('1234567890'),
            'created_by' => '1',
            'created_at' => Carbon::now()
        ]);

        User::create([
            'f_name' => 'Cleark',
            'm_name' => 'M',
            'l_name' => 'L',
            'role_id' => '3',
            'department_id' => '1',
            'phone_number' => '1234568890',
            'email' => 'cleark@gmail.com',
            'password' => Hash::make('1234567890'),
            'created_by' => '1',
            'created_at' => Carbon::now()
        ]);
    }
}
