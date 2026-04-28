<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialDate extends Model
{
    protected $fillable = ['user_id', 'title', 'event_date', 'category'];
public function user()
{
    return $this->belongsTo(User::class);
}
}