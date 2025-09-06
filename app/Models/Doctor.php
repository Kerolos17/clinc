<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{


    protected $fillable = [
        'name',
        'specialty_id',
        'photo',
        'bio',
        'location',
        'consultation_fee'
    ];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
