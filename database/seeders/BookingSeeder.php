<?php

namespace Database\Seeders;

use App\Models\Availability;
use App\Models\Booking;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first(); // أول مريض
        $doctor = Doctor::first();
        $availability = Availability::first();

        if ($user && $doctor && $availability) {
            Booking::create([
                'doctor_id' => $doctor->id,
                'user_id' => $user->id,
                'availability_id' => $availability->id,
                'total_price' => 100,
                'status' => 'confirmed',
                'payment_status' => 'paid',
            ]);
        }
    }
}
