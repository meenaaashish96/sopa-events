<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venues extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'event_id' ,'name', 'address', 'location', 'city', 'state', 'country', 'image', 'pincode', 'lat', 'long', 'airport', 'railway', 'contact_no1', 'contact_no2', 'status'
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }
}
