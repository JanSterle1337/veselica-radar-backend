<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'is_entrance_fee',
        'entrance_fee',
        'event_date',
        'starting_hour',
        'ending_hour',
    ];

    protected $casts = [
        'is_entrance_fee' => 'boolean',
        'entrance_fee' => 'float',
        'event_date' => 'date',
        'starting_hour' => 'datetime:H:i', // Cast to time format without seconds
        'ending_hour' => 'datetime:H:i',   // Cast to time format without seconds
    ];
}
