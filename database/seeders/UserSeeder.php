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
        //  Create a new user with all permissions and assign it to hod role
        User::create([
            'f_name' => 'Shiv',
            'm_name' => 'Santosh',
            'l_name' => 'Singh',
            'role_id' => '2',
            'department_id' => '1',
            'phone_number' => '1234565890',
            'email' => 'hod@gmail.com',
            'password' => Hash::make('1234567890'),
            'created_by' => '1',
            'created_at' => Carbon::now()
        ]);

        //  Create a new user with all permissions and assign it to cleark role
        User::create([
            'f_name' => 'Arvind',
            'm_name' => 'Rohit',
            'l_name' => 'Yadav',
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
