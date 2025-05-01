<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherObservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'latitude',
        'longitude',
        'location_city',
        'location_state',
        'time_zone',
        'event_date',
        'event_time',
        'weather_types',
        'damages',
        'event_description',
        'media_files'
    ];

    protected $casts = [
        'weather_types' => 'array',
        'damages' => 'array',
        'media_files' => 'array',
        'event_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 