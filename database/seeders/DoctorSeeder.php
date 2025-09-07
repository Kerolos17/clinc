<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $specialties = Specialty::all();

        foreach (range(1, 20) as $i) {
            Doctor::create([
                'name' => 'Dr. ' . fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'specialty_id' => $specialties->random()->id,
                'photo' => 'https://placehold.co/400x400',
                'bio' => fake()->paragraph(),
                'location' => fake()->city(),
                'consultation_fee' => fake()->randomFloat(2, 30, 200),
            ]);
        }
    }
}
