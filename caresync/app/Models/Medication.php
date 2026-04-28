<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $fillable = ['user_id', 'medicine_id', 'dosage', 'next_dose_at', 'frequency_hours', 'duration_days', 'doses_taken'];

public function medicine()
{
    return $this->belongsTo(Medicine::class);
}
}