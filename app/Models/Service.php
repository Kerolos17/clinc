<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
            'doctor_id',
            'name',
            'price'
    ];

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

}
