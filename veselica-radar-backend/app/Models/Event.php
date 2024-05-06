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
        'isEntranceFee',
        'entranceFee',
        'eventDate',
        'startingHour',
        'endingHour',
    ];

    protected $casts = [
        'isEntranceFee' => 'boolean',
        'entranceFee' => 'float',
        'eventDate' => 'date',
        'startingHour' => 'time',
        'endingHour' => 'time',
    ];
}
