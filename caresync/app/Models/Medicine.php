<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = ['user_id', 'name', 'dosage'];

    public function medications()
{
    return $this->hasMany(Medication::class);
}
}