<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'event_id' ,'title', 'image', 'location', 'speackers', 'to_time', 'from_time', 'schedule_date', 'type', 'status', 'description', 'points'
    ];

    protected $casts = [
        'speackers' => 'json',
        'points' => 'json'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }
}
