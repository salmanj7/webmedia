<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time',
        'end_time',
        'doctor_id',
        'user_id',
        'date',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
