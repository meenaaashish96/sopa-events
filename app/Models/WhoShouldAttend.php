<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhoShouldAttend extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'event_id' ,'title', 'order', 'description', 'status'
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }
}
