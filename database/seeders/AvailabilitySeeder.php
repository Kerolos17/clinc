<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Availability;
use Carbon\Carbon;

class AvailabilitySeeder extends Seeder
{
    public function run(): void
    {
        // نجيب أول 10 دكاترة كمثال
        $doctors = Doctor::take(10)->get();

        foreach ($doctors as $doctor) {
            // نولد مواعيد لـ 14 يوم قدام
            for ($i = 0; $i < 14; $i++) {
                $date = Carbon::today()->addDays($i);

                // 4 مواعيد كل يوم (ص, ظهر, عصر, مساء)
                $slots = [
                    ['09:00:00', '10:00:00'],
                    ['11:00:00', '12:00:00'],
                    ['14:00:00', '15:00:00'],
                    ['17:00:00', '18:00:00'],
                ];

                foreach ($slots as $slot) {
                    Availability::create([
                        'doctor_id'  => $doctor->id,
                        'date'       => $date->toDateString(),
                        'start_time' => $slot[0],
                        'end_time'   => $slot[1],
                        'is_booked'  => false,
                    ]);
                }
            }
        }
    }
}
