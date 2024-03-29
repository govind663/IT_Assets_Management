<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            UserSeeder::class,
            RoleSeeder::class,
            CatagorySeeder::class,
            UnitSeeder::class,
            VendorSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
