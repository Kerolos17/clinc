<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('specialty')->paginate(8);

        return view('doctors.index', compact('doctors'));
    }

    public function show(Doctor $doctor)
    {
        // eager load relations
        $doctor->load(['specialty', 'services', 'availabilities']);

        return view('doctors.show', compact('doctor'));
    }

    // API لإرجاع الـ slots حسب التاريخ
    public function availabilities(Request $request, $doctorId)
    {
        $date = $request->query('date');

        if (!$date) {
            return response()->json(['error' => 'Date is required'], 400);
        }

        $slots = Availability::where('doctor_id', $doctorId)
            ->whereDate('date', $date)
            ->where('is_booked', false) // ✅ فلتر بس المتاح
            ->get();

        return response()->json($slots);
    }
}
