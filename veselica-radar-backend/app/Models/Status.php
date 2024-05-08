<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'user_id',
        'status',
        'event_id',
    ];

    protected $primaryKey = ['user_id', 'event_id'];

    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
    protected $touches = ['user', 'event'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function event() {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
