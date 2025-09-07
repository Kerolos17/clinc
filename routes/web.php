<?php

use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Support\Facades\Route;



// routes/web.php
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('bookings', AdminBookingController::class);
});



Route::get('/', function () {
    $doctors = Doctor::with('specialty')->latest()->take(6)->get();
    $specialties = Specialty::withCount('doctors')->get();
    return view('welcome', compact('doctors', 'specialties'));
});

Route::get('/specialties/{specialty}', [SpecialtyController::class, 'show'])->name('specialties.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
Route::get('/doctors/{doctor}', [DoctorController::class, 'show'])->name('doctors.show');
Route::get('/doctors/{doctor}/availabilities', [DoctorController::class, 'availabilities']);
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{booking}/payment', [BookingController::class, 'payment'])->name('bookings.payment');
Route::post('/bookings/{booking}/confirm', [BookingController::class, 'confirm'])->name('bookings.confirm');
Route::get('/bookings/{booking}/success', [BookingController::class, 'success'])->name('bookings.success');
require __DIR__ . '/auth.php';
