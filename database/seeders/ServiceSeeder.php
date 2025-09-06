<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = Doctor::all();

        foreach ($doctors as $doctor) {
            Service::create([
                'doctor_id' => $doctor->id,
                'name' => 'General Consultation',
                'price' => 50,
            ]);

            Service::create([
                'doctor_id' => $doctor->id,
                'name' => 'Follow-up Visit',
                'price' => 30,
            ]);

            Service::create([
                'doctor_id' => $doctor->id,
                'name' => 'Specialized Treatment',
                'price' => 80,
            ]);
        }
    }
}
