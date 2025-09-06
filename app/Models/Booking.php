<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'user_id',
        'availability_id',
        'total_price',
        'status',
        'payment_status',
        'patient_name',
        'patient_email',
        'patient_phone',
    ];

    // العلاقات
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function availability()
    {
        return $this->belongsTo(Availability::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'booking_service')
            ->withPivot('price')
            ->withTimestamps();
    }
}
