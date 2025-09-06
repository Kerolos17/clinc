<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create(); // إنشاء 10 مستخدمين كمثال
        $this->call([
            SpecialtySeeder::class,
            DoctorSeeder::class,
            ServiceSeeder::class,
            AvailabilitySeeder::class,
            BookingSeeder::class,
        ]);
    }
}
