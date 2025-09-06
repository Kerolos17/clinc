<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function index(Doctor $doctor, Request $request)
    {
        $date = $request->query('date'); // ?date=YYYY-MM-DD

        $availabilities = $doctor->availabilities()
            ->when($date, fn($q) => $q->where('date', $date))
            ->where('is_booked', false)
            ->orderBy('start_time')
            ->get();

        return response()->json($availabilities);
    }
}
