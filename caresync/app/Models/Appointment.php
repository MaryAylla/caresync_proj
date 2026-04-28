<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['user_id', 'doctor_id', 'appointment_at', 'description'];

    public function doctor()
{
    return $this->belongsTo(Doctor::class);
}
}