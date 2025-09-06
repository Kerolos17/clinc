<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function show(Specialty $specialty)
    {
        $doctors = $specialty->doctors()->paginate(9);
        return view('specialties.show', compact('specialty', 'doctors'));
    }
}
