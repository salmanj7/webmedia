<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialization'
    ];

    public function availability()
    {
        return $this->hasMany(Availability::class);
    }


    public function getAvailableDaysAttribute()
    {
        return $this->availability->map->day->unique()->values()->toArray();
    }

    public function getAvailableDates()
    {
        $dates = [];
        $currentDate = now();


        for ($i = 0; $i < 60; $i++) {
            if ($this->isAvailableDay($currentDate->format('l'))) {
                $dates[] = $currentDate->format('Y-m-d');
            }
            $currentDate->addDay();
        }

        return $dates;
    }

    protected function isAvailableDay($day)
    {
        return in_array(strtolower($day), array_map('strtolower', $this->getAvailableDaysAttribute()));
    }

    public function getAvailableTimesForDate($selectedDate)
    {
        $availableTimes = [];

        foreach ($this->availability as $availability) {
            if ($availability->day === Carbon::parse($selectedDate)->format('l')) {
                $availableTimes[] = $availability->start_time . ' - ' . $availability->end_time;
            }
        }

        return $availableTimes;
    }
    
    


}
